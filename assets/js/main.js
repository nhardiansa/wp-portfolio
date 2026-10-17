( () => {
	'use strict';

	const root = document.documentElement;
	const prefersReducedMotion = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
	const animeApi = window.anime;
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

	const splitHeading = ( el ) => {
		if ( '1' === el.dataset.wordsReady || ! motion ) {
			return [];
		}
		el.style.opacity = '1';
		const words = el.textContent.trim().split( /\s+/ ).filter( Boolean );
		el.textContent = '';
		const inners = [];
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
			inners.push( inner );
		} );
		el.dataset.wordsReady = '1';
		return inners;
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

			hero.querySelectorAll( '.hero-fade, .hero-rule, .hero-photo' ).forEach( ( el ) => {
				animeApi.animate( el, {
					opacity: [ 0, 1 ],
					translateY: [ 16, 0 ],
					duration: 900,
					delay: reduceInlineDelay( el ),
					ease: 'outQuart',
				} );
			} );
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
