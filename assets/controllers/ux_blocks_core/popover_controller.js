import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        this.onKeydown = this.onKeydown.bind(this);
        this.element.addEventListener('keydown', this.onKeydown);
    }

    disconnect() {
        this.element.removeEventListener('keydown', this.onKeydown);
    }

    onKeydown(event) {
        if (event.key !== 'Escape' || !this.element.matches(':popover-open')) {
            return;
        }

        this.element.hidePopover();
        const trigger = document.querySelector(`[popovertarget="${this.element.id}"]`);
        trigger?.focus();
    }
}
