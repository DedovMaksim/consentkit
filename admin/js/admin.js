document.addEventListener('DOMContentLoaded', () => {
	const tabs = document.querySelectorAll('.consentkit-tab');
	const panels = document.querySelectorAll('.consentkit-tab-panel');

	if (!tabs.length || !panels.length) {
		return;
	}

	const activateTab = (tabName) => {
		tabs.forEach((tab) => {
			const isActive = tab.dataset.consentkitTab === tabName;

			tab.classList.toggle('is-active', isActive);
			tab.setAttribute('aria-selected', isActive ? 'true' : 'false');
		});

		panels.forEach((panel) => {
			const isActive = panel.dataset.consentkitPanel === tabName;

			panel.classList.toggle('is-active', isActive);
			panel.hidden = !isActive;
		});

		window.location.hash = `tab-${tabName}`;
	};

	const initialHash = window.location.hash.replace('#tab-', '');
	const initialTab = initialHash || 'general';

	activateTab(initialTab);

	tabs.forEach((tab) => {
		tab.addEventListener('click', () => {
			activateTab(tab.dataset.consentkitTab);
		});
	});
});