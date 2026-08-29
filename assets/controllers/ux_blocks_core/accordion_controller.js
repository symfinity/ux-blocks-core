import { Controller } from '@hotwired/stimulus';

const CHEVRON_HTML =
    '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" focusable="false" aria-hidden="true">' +
    '<path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>' +
    '</svg>';

/**
 * Accordion helper: Bootstrap chevron SVG + single-mode `name` group (data-bs-parent).
 */
export default class extends Controller {
    static values = {
        type: { type: String, default: 'single' },
        groupName: String,
    };

    connect() {
        this.#ensureChevrons();

        if (this.typeValue !== 'single') {
            return;
        }

        const groupName = this.groupNameValue || `accordion-${crypto.randomUUID?.() ?? Date.now()}`;

        this.element.querySelectorAll('details').forEach((details) => {
            if (!details.name) {
                details.name = groupName;
            }
        });
    }

    #ensureChevrons() {
        this.element.querySelectorAll('summary').forEach((summary) => {
            let chevron = summary.querySelector('.ux-accordion-chevron');

            if (!chevron) {
                chevron = document.createElement('span');
                chevron.className = 'ux-accordion-chevron';
                chevron.setAttribute('aria-hidden', 'true');
                summary.appendChild(chevron);
            }

            if (!chevron.querySelector('svg')) {
                chevron.innerHTML = CHEVRON_HTML;
            }
        });
    }
}
