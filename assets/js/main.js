( () => {
	'use strict';

	const prefersReducedMotion = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

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

	const revealTargets = document.querySelectorAll( '[data-reveal], [data-reveal-group]' );
	if ( 'IntersectionObserver' in window ) {
		const observer = new IntersectionObserver( ( entries, obs ) => {
			entries.forEach( ( entry ) => {
				if ( entry.isIntersecting ) {
					entry.target.classList.add( 'is-revealed' );
					obs.unobserve( entry.target );
				}
			} );
		}, { threshold: 0.15, rootMargin: '0px 0px -8% 0px' } );
		revealTargets.forEach( ( el ) => observer.observe( el ) );
	} else {
		revealTargets.forEach( ( el ) => el.classList.add( 'is-revealed' ) );
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
