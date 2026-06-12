import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    /** @type {((event: Event) => void) | null} */
    #onToggle = null;

    static values = {
        type: { type: String, default: 'single' },
        groupName: String,
    };

    connect() {
        if (this.typeValue !== 'single') {
            return;
        }

        this.#bindDetailsGroup();
        this.#onToggle = this.#handleToggle.bind(this);
        this.element.addEventListener('toggle', this.#onToggle, true);
    }

    disconnect() {
        if (this.#onToggle) {
            this.element.removeEventListener('toggle', this.#onToggle, true);
        }
    }

    #bindDetailsGroup() {
        const groupName = this.groupNameValue || `accordion-${crypto.randomUUID?.() ?? Date.now()}`;

        this.detailsElements.forEach((details) => {
            details.name = groupName;
        });
    }

    #handleToggle(event) {
        if (this.typeValue !== 'single') {
            return;
        }

        const target = event.target;
        if (!(target instanceof HTMLDetailsElement) || !target.open) {
            return;
        }

        this.detailsElements.forEach((details) => {
            if (details !== target && details.open) {
                details.open = false;
            }
        });
    }

    get detailsElements() {
        return [...this.element.querySelectorAll('details')];
    }
}
