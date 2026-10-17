( () => {
	'use strict';

	const root = document.documentElement;
	const prefersReducedMotion = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
	const animeApi = window.anime;
	const gsapApi = window.gsap;
	const motion = ! prefersReducedMotion && animeApi && 'function' === typeof animeApi.animate;

	window.__nabpMotion = true;

	if ( motion ) {
		root.classList.add( 'motion-ready' );
	} else if ( prefersReducedMotion || ! animeApi ) {
		root.classList.add( 'motion-failed' );
	}

	const showAll = ( els ) => {
		els.forEach( ( el ) => {
			el.style.opacity = '';
			el.style.transform = '';
		} );
	};

	document.querySelectorAll( 'a[href^="#"]' ).forEach( ( link ) => {
		link.addEventListener( 'click', ( event ) => {
			const target = document.querySelector( link.getAttribute( 'href' ) );
			if ( target ) {
				event.preventDefault();
				target.scrollIntoView( { behavior: prefersReducedMotion ? 'auto' : 'smooth' } );
			}
		} );
	} );

	const navLinks = document.querySelectorAll( '[data-nav-link]' );
	if ( navLinks.length && 'IntersectionObserver' in window ) {
		const sections = [];
		navLinks.forEach( ( link ) => {
			const section = document.querySelector( link.getAttribute( 'href' ) );
			if ( section ) {
				sections.push( { link, section } );
			}
		} );

		if ( sections.length ) {
			const spy = new IntersectionObserver( ( entries ) => {
				entries.forEach( ( entry ) => {
					if ( ! entry.isIntersecting ) {
						return;
					}
					navLinks.forEach( ( link ) => {
						link.classList.remove( 'is-active' );
						link.removeAttribute( 'aria-current' );
					} );
					const match = sections.find( ( item ) => item.section === entry.target );
					if ( match ) {
						match.link.classList.add( 'is-active' );
						match.link.setAttribute( 'aria-current', 'true' );
					}
				} );
			}, { rootMargin: '-45% 0px -50% 0px', threshold: 0 } );

			sections.forEach( ( item ) => spy.observe( item.section ) );
		}
	}

	if ( gsapApi ) {
		try {
			if ( gsapApi.registerPlugin && window.CustomEase ) {
				gsapApi.registerPlugin( window.CustomEase );
			}
			if ( ! gsapApi.parseEase( 'nav-ease' ) ) {
				if ( window.CustomEase ) {
					window.CustomEase.create( 'nav-ease', '0.65, 0.01, 0.05, 0.99' );
				}
				gsapApi.defaults( { ease: 'power2.out', duration: 0.7 } );
			}
		} catch ( e ) {
			gsapApi.defaults( { ease: 'power2.out', duration: 0.7 } );
		}
	}

	const setupNavOverlay = () => {
		const toggles = Array.from( document.querySelectorAll( '[data-nav-toggle]' ) );
		const wrapper = document.getElementById( 'nav-overlay' );
		if ( ! toggles.length || ! wrapper ) {
			return;
		}

		const menu = wrapper.querySelector( '.menu-content' );
		const overlay = wrapper.querySelector( '.overlay' );
		const panels = wrapper.querySelectorAll( '.backdrop-layer' );
		const links = wrapper.querySelectorAll( '.nav-link' );
		const fadeTargets = wrapper.querySelectorAll( '[data-menu-fade]' );
		const bars = toggles.flatMap( ( t ) => Array.from( t.querySelectorAll( '.nav-hamburger-bar' ) ) );
		const tops = bars.filter( ( _, i ) => 0 === i % 3 );
		const middles = bars.filter( ( _, i ) => 1 === i % 3 );
		const bottoms = bars.filter( ( _, i ) => 2 === i % 3 );
		let isOpen = false;
		let tl = null;

		const setState = ( open ) => {
			wrapper.setAttribute( 'data-nav', open ? 'open' : 'closed' );
			wrapper.setAttribute( 'aria-hidden', String( ! open ) );
			toggles.forEach( ( t ) => t.setAttribute( 'aria-expanded', String( open ) ) );
			document.body.style.overflow = open ? 'hidden' : '';
		};

		const openInstant = () => {
			wrapper.style.display = 'block';
			setState( true );
		};

		const closeInstant = () => {
			wrapper.style.display = 'none';
			setState( false );
		};

		if ( ! gsapApi || prefersReducedMotion ) {
			toggles.forEach( ( t ) => t.addEventListener( 'click', () => ( isOpen ? closeInstant() : openInstant() ) ) );
			if ( overlay ) {
				overlay.addEventListener( 'click', closeInstant );
			}
			window.addEventListener( 'keydown', ( e ) => {
				if ( 'Escape' === e.key && isOpen ) {
					closeInstant();
				}
			} );
			return;
		}

		const build = () => {
			tl = gsapApi.timeline( { paused: true, onReverseComplete: () => {
				wrapper.style.display = 'none';
				setState( false );
			} } );
			tl.set( wrapper, { display: 'block' } )
				.fromTo( overlay, { autoAlpha: 0 }, { autoAlpha: 1, duration: 0.35 }, 0 )
				.fromTo( panels, { xPercent: 101 }, { xPercent: 0, duration: 0.575, stagger: 0.12, ease: 'nav-ease' }, 0 )
				.fromTo( links, { yPercent: 140, rotate: 10 }, { yPercent: 0, rotate: 0, duration: 0.7, stagger: 0.05, ease: 'nav-ease' }, 0.35 )
				.fromTo( fadeTargets, { autoAlpha: 0, yPercent: 50 }, { autoAlpha: 1, yPercent: 0, duration: 0.5, stagger: 0.04, clearProps: 'all' }, 0.55 )
				.to( tops, { rotate: 45, y: 10, duration: 0.4, ease: 'power2.out' }, 0 )
				.to( middles, { opacity: 0, duration: 0.3 }, 0 )
				.to( bottoms, { rotate: -45, y: -10, duration: 0.4, ease: 'power2.out' }, 0 );
		};

		const openMenu = () => {
			isOpen = true;
			setState( true );
			tl.timeScale( 1 ).play();
		};

		const closeMenu = () => {
			isOpen = false;
			toggles.forEach( ( t ) => t.setAttribute( 'aria-expanded', 'false' ) );
			document.body.style.overflow = '';
			tl.timeScale( 1.6 ).reverse();
		};

		build();
		toggles.forEach( ( t ) => t.addEventListener( 'click', () => ( isOpen ? closeMenu() : openMenu() ) ) );
		overlay.addEventListener( 'click', closeMenu );
		wrapper.querySelectorAll( '.menu-list-item a' ).forEach( ( link ) => {
			link.addEventListener( 'click', closeMenu );
		} );
		window.addEventListener( 'keydown', ( e ) => {
			if ( 'Escape' === e.key && isOpen ) {
				closeMenu();
			}
		} );

		const shapeItems = wrapper.querySelectorAll( '.menu-list-item[data-shape]' );
		const shapesWrap = wrapper.querySelector( '.ambient-background-shapes' );
		shapeItems.forEach( ( item ) => {
			const shape = shapesWrap ? shapesWrap.querySelector( `.bg-shape-${item.getAttribute( 'data-shape' )}` ) : null;
			if ( ! shape ) {
				return;
			}
			const els = shape.querySelectorAll( '.shape-element' );
			const onEnter = () => {
				if ( shapesWrap ) {
					shapesWrap.querySelectorAll( '.bg-shape' ).forEach( ( s ) => s.classList.remove( 'active' ) );
				}
				shape.classList.add( 'active' );
				gsapApi.fromTo( els,
					{ scale: 0.5, opacity: 0, rotation: -10 },
					{ scale: 1, opacity: 1, rotation: 0, duration: 0.6, stagger: 0.08, ease: 'back.out(1.7)', overwrite: 'auto' }
				);
			};
			const onLeave = () => {
				gsapApi.to( els, {
					scale: 0.8,
					opacity: 0,
					duration: 0.3,
					ease: 'power2.in',
					onComplete: () => shape.classList.remove( 'active' ),
					overwrite: 'auto',
				} );
			};
			item.addEventListener( 'mouseenter', onEnter );
			item.addEventListener( 'mouseleave', onLeave );
		} );
	};

	setupNavOverlay();

	const siteHeader = document.querySelector( '.site-header' );
	if ( siteHeader ) {
		const onHeaderScroll = () => siteHeader.classList.toggle( 'is-scrolled', window.scrollY > 24 );
		onHeaderScroll();
		window.addEventListener( 'scroll', onHeaderScroll, { passive: true } );
	}

	const splitHeading = ( el ) => {
		if ( ! motion ) {
			return [];
		}
		if ( '1' !== el.dataset.wordsReady ) {
			el.style.opacity = '1';
			const words = el.textContent.trim().split( /\s+/ ).filter( Boolean );
			el.textContent = '';
			words.forEach( ( word, index ) => {
				const mask = document.createElement( 'span' );
				mask.className = 'heading-mask';
				const inner = document.createElement( 'span' );
				inner.className = 'heading-word';
				inner.textContent = word;
				mask.appendChild( inner );
				el.appendChild( mask );
				if ( index < words.length - 1 ) {
					el.appendChild( document.createTextNode( ' ' ) );
				}
			} );
			el.dataset.wordsReady = '1';
		}
		return Array.from( el.querySelectorAll( '.heading-word' ) );
	};

	document.querySelectorAll( '[data-reveal-lines]' ).forEach( ( el ) => {
		if ( motion ) {
			splitHeading( el );
		}
	} );

	const reduceInlineDelay = ( el ) => {
		const raw = getComputedStyle( el ).getPropertyValue( '--d' ).trim();
		const parsed = parseFloat( raw );
		return Number.isFinite( parsed ) ? parsed : 0;
	};

	if ( motion ) {
		const hero = document.querySelector( '#hero' );
		if ( hero ) {
			const lines = hero.querySelectorAll( '.hero-mask-line' );
			animeApi.animate( lines, {
				opacity: [ 0, 1 ],
				translateY: [ '115%', '0%' ],
				duration: 1050,
				delay: animeApi.stagger( 140, { start: 140 } ),
				ease: 'outExpo',
			} );

			hero.querySelectorAll( '.hero-fade, .hero-photo' ).forEach( ( el ) => {
				animeApi.animate( el, {
					opacity: [ 0, 1 ],
					translateY: [ 16, 0 ],
					duration: 900,
					delay: reduceInlineDelay( el ),
					ease: 'outQuart',
				} );
			} );

			const rule = hero.querySelector( '.hero-rule' );
			if ( rule ) {
				animeApi.animate( rule, {
					opacity: [ 0, 1 ],
					scaleX: [ 0, 1 ],
					duration: 1000,
					delay: reduceInlineDelay( rule ),
					ease: 'outExpo',
				} );
			}
		}
	}

	if ( motion && gsapApi && window.matchMedia( '(pointer: fine)' ).matches ) {
		const heroPhoto = document.querySelector( '.hero-photo' );
		if ( heroPhoto ) {
			const frame = heroPhoto.querySelector( '.hero-photo-frame' );
			const img = heroPhoto.querySelector( 'img' );
			if ( frame && img ) {
				gsapApi.set( img, { transformPerspective: 900 } );

				const frameX = gsapApi.quickTo( frame, 'x', { duration: 0.4, ease: 'power3' } );
				const frameY = gsapApi.quickTo( frame, 'y', { duration: 0.4, ease: 'power3' } );
				const rotX = gsapApi.quickTo( img, 'rotationX', { duration: 0.5, ease: 'power3' } );
				const rotY = gsapApi.quickTo( img, 'rotationY', { duration: 0.5, ease: 'power3' } );

				heroPhoto.addEventListener( 'mousemove', ( e ) => {
					const rect = heroPhoto.getBoundingClientRect();
					const px = ( e.clientX - rect.left ) / rect.width - 0.5;
					const py = ( e.clientY - rect.top ) / rect.height - 0.5;
					rotY( px * 7 );
					rotX( -py * 5 );
					frameX( px * 14 );
					frameY( py * 14 );
				} );

				heroPhoto.addEventListener( 'mouseleave', () => {
					rotX( 0 );
					rotY( 0 );
					frameX( 0 );
					frameY( 0 );
				} );
			}
		}
	}

	const revealOne = ( el ) => {
		if ( ! motion ) {
			return;
		}
		if ( el.hasAttribute( 'data-reveal-lines' ) ) {
			const words = splitHeading( el );
			animeApi.animate( words, {
				opacity: [ 0, 1 ],
				translateY: [ '110%', '0%' ],
				duration: 900,
				delay: animeApi.stagger( 55 ),
				ease: 'outExpo',
			} );
			return;
		}
		if ( el.hasAttribute( 'data-reveal-group' ) ) {
			const children = Array.from( el.children );
			animeApi.animate( children, {
				opacity: [ 0, 1 ],
				translateY: [ 20, 0 ],
				duration: 700,
				delay: animeApi.stagger( 80 ),
				ease: 'outQuart',
			} );
			return;
		}
		animeApi.animate( el, {
			opacity: [ 0, 1 ],
			translateY: [ 20, 0 ],
			duration: 700,
			ease: 'outQuart',
		} );
	};

	const revealTargets = document.querySelectorAll( '[data-reveal], [data-reveal-group], [data-reveal-lines]' );

	if ( ! motion ) {
		showAll( Array.from( revealTargets ) );
		document.querySelectorAll( '[data-reveal-group]' ).forEach( ( group ) => {
			showAll( Array.from( group.children ) );
		} );
	} else if ( 'IntersectionObserver' in window ) {
		const observer = new IntersectionObserver( ( entries, obs ) => {
			entries.forEach( ( entry ) => {
				if ( entry.isIntersecting ) {
					revealOne( entry.target );
					obs.unobserve( entry.target );
				}
			} );
		}, { threshold: 0.15, rootMargin: '0px 0px -8% 0px' } );

		revealTargets.forEach( ( el ) => observer.observe( el ) );
	} else {
		revealTargets.forEach( revealOne );
	}

	const track = ( name, params ) => {
		if ( 'function' === typeof window.gtag ) {
			window.gtag( 'event', name, params || {} );
		}
	};

	document.addEventListener( 'click', ( event ) => {
		const el = event.target.closest( '[data-ga]' );
		if ( el ) {
			track( el.getAttribute( 'data-ga' ) );
		}
	} );

	const caseStudy = document.querySelector( '[data-ga-case-study]' );
	if ( caseStudy ) {
		track( 'case_study_open', { case_study: caseStudy.getAttribute( 'data-ga-case-study' ) } );
	}
} )();
