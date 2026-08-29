import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['content'];

    static values = {
        open: Boolean,
        contentId: String,
        disabled: Boolean,
    };

    toggle(event) {
        if (this.disabledValue) {
            event.preventDefault();

            return;
        }

        this.openValue = !this.openValue;
        this.sync();
    }

    openValueChanged() {
        this.sync();
    }

    sync() {
        const trigger = this.element.querySelector('[data-ui-role="collapsible-trigger"]');
        const content = this.hasContentTarget ? this.contentTarget : this.element.querySelector('[data-ui-role="collapsible-content"]');

        if (trigger && trigger.tagName !== 'SUMMARY') {
            trigger.setAttribute('aria-expanded', this.openValue ? 'true' : 'false');
        }

        if (!content) {
            return;
        }

        this.element.dataset.uiState = this.openValue ? 'open' : 'closed';

        if (this.openValue) {
            content.hidden = false;
            content.removeAttribute('aria-hidden');
        } else {
            content.hidden = true;
            content.setAttribute('aria-hidden', 'true');
        }
    }
}
