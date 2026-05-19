document.addEventListener('DOMContentLoaded', () => {

	const STORAGE_KEY = 'consentkit_preferences';

	const banner = document.getElementById('consentkit-banner');
	const modal = document.getElementById('consentkit-modal');
	const form = document.getElementById('consentkit-preferences');
	const preferencesButton = document.getElementById('consentkit-preferences-button');
	const preferencesWrapper = document.getElementById('consentkit-preferences-wrapper');
	const preferencesClose = document.getElementById('consentkit-preferences-close');
	const preferencesButtonHiddenKey = 'consentkit_preferences_button_hidden';

	let lastFocusedElement = null;

	const applyPrimaryColor = () => {

		if (
			typeof ConsentKitData === 'undefined' ||
			!ConsentKitData.primaryColor
		) {
			return;
		}

		document.documentElement.style.setProperty(
			'--consentkit-primary-color',
			ConsentKitData.primaryColor
		);
	};

	const getFocusableElements = () => {

		if ( ! modal ) {
			return [];
		}

		return Array.from(
			modal.querySelectorAll(
				'a[href], button:not([disabled]), textarea:not([disabled]), input:not([disabled]), select:not([disabled]), [tabindex]:not([tabindex="-1"])'
			)
		);
	};

	const getExpirationDays = () => {

		if (
			typeof ConsentKitData === 'undefined' ||
			! ConsentKitData.cookieExpiration
		) {
			return 180;
		}

		return parseInt( ConsentKitData.cookieExpiration, 10 ) || 180;
	};

	const isGoogleConsentModeEnabled = () => {

		return !! (
			typeof ConsentKitData !== 'undefined' &&
			ConsentKitData.enableGoogleConsentMode
		);
	};

	const updateGoogleConsentMode = ( preferences ) => {

		if (
			! isGoogleConsentModeEnabled() ||
			typeof window.gtag !== 'function'
		) {
			return;
		}

		window.gtag( 'consent', 'update', {
			analytics_storage: preferences.analytics ? 'granted' : 'denied',
			ad_storage: preferences.marketing ? 'granted' : 'denied',
			ad_user_data: preferences.marketing ? 'granted' : 'denied',
			ad_personalization: preferences.marketing ? 'granted' : 'denied',
			functionality_storage: preferences.functional ? 'granted' : 'denied',
			security_storage: 'granted'
		} );
	};

	const setDefaultGoogleConsentMode = () => {

		if (
			! isGoogleConsentModeEnabled() ||
			typeof window.gtag !== 'function'
		) {
			return;
		}

		window.gtag( 'consent', 'default', {
			analytics_storage: 'denied',
			ad_storage: 'denied',
			ad_user_data: 'denied',
			ad_personalization: 'denied',
			functionality_storage: 'denied',
			security_storage: 'granted'
		} );
	};

	const getPreferences = () => {

		try {
			return JSON.parse(
				localStorage.getItem( STORAGE_KEY )
			);
		} catch ( e ) {
			return null;
		}
	};

	const isExpired = ( preferences ) => {

		if ( ! preferences || ! preferences.updatedAt ) {
			return true;
		}

		const expirationDays = getExpirationDays();
		const expirationMs = expirationDays * 24 * 60 * 60 * 1000;

		return Date.now() - preferences.updatedAt > expirationMs;
	};

	const resetPreferences = () => {

		localStorage.removeItem( STORAGE_KEY );

		if ( preferencesButton ) {
			preferencesWrapper.hidden = true;
		}

		showBanner();
		closeModal();
	};

	const showPreferencesButton = () => {

		if (
			preferencesWrapper &&
			localStorage.getItem(preferencesButtonHiddenKey) !== '1'
		) {
			preferencesWrapper.hidden = false;
		}
	};

	const loadAcceptedScripts = ( preferences ) => {

		document
			.querySelectorAll(
				'script[type="text/plain"][data-consentkit-category]'
			)
			.forEach( ( placeholder ) => {

				const category = placeholder.dataset.consentkitCategory;

				if ( ! preferences || ! preferences[ category ] ) {
					return;
				}

				if ( placeholder.dataset.consentkitLoaded === '1' ) {
					return;
				}

				// ТЕПЕРЬ ЧИТАЕМ ИЗ АТРИБУТА data-consentkit-source
				const encodedContent = placeholder.getAttribute('data-consentkit-source');

				if ( ! encodedContent ) {
					return;
				}

				let decodedContent = '';

				try {
					// ЗАМЕНЯЕМ СТАРЫЙ atob НА ЛЕГАЛЬНЫЙ decodeURIComponent
					decodedContent = decodeURIComponent( encodedContent );
				} catch ( error ) {
					return;
				}

				const template = document.createElement( 'template' );
				template.innerHTML = decodedContent.trim();

				const scripts = template.content.querySelectorAll( 'script' );

				if ( scripts.length ) {

					scripts.forEach( ( oldScript ) => {

						const newScript = document.createElement( 'script' );

						Array.from( oldScript.attributes ).forEach( ( attr ) => {
							newScript.setAttribute( attr.name, attr.value );
						} );

						newScript.textContent = oldScript.textContent || '';

						document.head.appendChild( newScript );
					} );

				} else {

					const newScript = document.createElement( 'script' );
					newScript.textContent = decodedContent;

					document.head.appendChild( newScript );
				}

				placeholder.dataset.consentkitLoaded = '1';
				placeholder.remove();
			} );
	};

	const savePreferences = ( preferences ) => {

		localStorage.setItem(
			STORAGE_KEY,
			JSON.stringify( preferences )
		);

		loadAcceptedScripts( preferences );
		updateGoogleConsentMode( preferences );
		showPreferencesButton();

		document.dispatchEvent(
			new CustomEvent(
				'consentkit:updated',
				{
					detail: preferences
				}
			)
		);
	};

	const hideBanner = () => {

		if ( banner ) {
			banner.hidden = true;
		}
	};

	const showBanner = () => {

		if ( banner ) {
			banner.hidden = false;
		}
	};

	const openModal = () => {

		if ( ! modal ) {
			return;
		}

		lastFocusedElement = document.activeElement;

		modal.hidden = false;
		modal.setAttribute( 'aria-hidden', 'false' );

		document.body.classList.add(
			'consentkit-modal-open'
		);

		const dialog = modal.querySelector(
			'.consentkit-modal__dialog'
		);

		const focusableElements =
			getFocusableElements();

		if ( dialog ) {
			dialog.focus();
		} else if ( focusableElements.length ) {
			focusableElements[0].focus();
		}
	};

	const closeModal = () => {

		if ( ! modal ) {
			return;
		}

		modal.hidden = true;
		modal.setAttribute( 'aria-hidden', 'true' );

		document.body.classList.remove(
			'consentkit-modal-open'
		);

		if (
			lastFocusedElement &&
			typeof lastFocusedElement.focus === 'function'
		) {
			lastFocusedElement.focus();
		}
	};

	const acceptAll = () => {

		savePreferences( {
			required: true,
			analytics: true,
			functional: true,
			marketing: true,
			updatedAt: Date.now()
		} );

		hideBanner();
		closeModal();
	};

	const rejectOptional = () => {

		savePreferences( {
			required: true,
			analytics: false,
			functional: false,
			marketing: false,
			updatedAt: Date.now()
		} );

		hideBanner();
		closeModal();
	};

	const fillForm = ( preferences ) => {

		if ( ! form || ! preferences ) {
			return;
		}

		[
			'analytics',
			'functional',
			'marketing'
		].forEach( ( key ) => {

			const field = form.querySelector(
				`input[name="${key}"]`
			);

			if ( field ) {
				field.checked = !! preferences[ key ];
			}
		} );
	};

	applyPrimaryColor();
	setDefaultGoogleConsentMode();

	const existingPreferences = getPreferences();

	if (
		! existingPreferences ||
		isExpired( existingPreferences )
	) {

		localStorage.removeItem( STORAGE_KEY );

        fillForm( {
            required: true,
            analytics: true,
            functional: true,
            marketing: true
        } );

		showBanner();

	} else {

		fillForm( existingPreferences );
		loadAcceptedScripts( existingPreferences );
		updateGoogleConsentMode( existingPreferences );
		showPreferencesButton();
	}

	document
		.querySelectorAll(
			'[data-consentkit-open-modal]'
		)
		.forEach( ( button ) => {

			button.addEventListener(
				'click',
				openModal
			);
		} );

	document
		.querySelectorAll(
			'[data-consentkit-close-modal]'
		)
		.forEach( ( button ) => {

			button.addEventListener(
				'click',
				closeModal
			);
		} );

	document
		.querySelectorAll(
			'[data-consentkit-accept-all]'
		)
		.forEach( ( button ) => {

			button.addEventListener(
				'click',
				acceptAll
			);
		} );

	document
		.querySelectorAll(
			'[data-consentkit-reject]'
		)
		.forEach( ( button ) => {

			button.addEventListener(
				'click',
				rejectOptional
			);
		} );

	document
		.querySelectorAll(
			'[data-consentkit-reset]'
		)
		.forEach( ( button ) => {

			button.addEventListener(
				'click',
				resetPreferences
			);
		} );

	if ( preferencesClose && preferencesWrapper ) {
		preferencesClose.addEventListener(
			'click',
			() => {
				localStorage.setItem( preferencesButtonHiddenKey, '1' );
				preferencesWrapper.hidden = true;
			}
		);
	}	

	if ( form ) {

		form.addEventListener(
			'submit',
			( event ) => {

				event.preventDefault();

				savePreferences( {
					required: true,
					analytics: form.analytics.checked,
					functional: form.functional.checked,
					marketing: form.marketing.checked,
					updatedAt: Date.now()
				} );

				hideBanner();
				closeModal();
			}
		);
	}

	document.addEventListener(
		'keydown',
		( event ) => {

			if ( ! modal || modal.hidden ) {
				return;
			}

			if ( event.key === 'Escape' ) {
				closeModal();
				return;
			}

			if ( event.key !== 'Tab' ) {
				return;
			}

			const focusableElements =
				getFocusableElements();

			if ( ! focusableElements.length ) {

				event.preventDefault();
				return;
			}

			const firstElement =
				focusableElements[0];

			const lastElement =
				focusableElements[
					focusableElements.length - 1
				];

			if (
				event.shiftKey &&
				document.activeElement === firstElement
			) {

				event.preventDefault();
				lastElement.focus();
			}

			if (
				! event.shiftKey &&
				document.activeElement === lastElement
			) {

				event.preventDefault();
				firstElement.focus();
			}
		}
	);
});