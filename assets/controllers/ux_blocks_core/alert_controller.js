import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        this.onDismiss = this.onDismiss.bind(this);
        this.element.addEventListener('click', this.onDismiss);
    }

    disconnect() {
        this.element.removeEventListener('click', this.onDismiss);
    }

    dismiss(event) {
        event.preventDefault();
        this.dismissElement();
    }

    onDismiss(event) {
        const trigger = event.target.closest('[data-alert-dismiss]');
        if (!trigger || !this.element.contains(trigger)) {
            return;
        }

        event.preventDefault();
        this.dismissElement();
    }

    dismissElement() {
        this.element.hidden = true;
        this.element.setAttribute('aria-hidden', 'true');
        this.element.dataset.uiState = 'dismissed';
    }
}
