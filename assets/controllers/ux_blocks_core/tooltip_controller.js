import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['trigger', 'content'];

    connect() {
        this.show = this.show.bind(this);
        this.hide = this.hide.bind(this);
        this.triggerTarget.addEventListener('focus', this.show);
        this.triggerTarget.addEventListener('blur', this.hide);
        this.triggerTarget.addEventListener('mouseenter', this.show);
        this.triggerTarget.addEventListener('mouseleave', this.hide);
    }

    disconnect() {
        this.triggerTarget.removeEventListener('focus', this.show);
        this.triggerTarget.removeEventListener('blur', this.hide);
        this.triggerTarget.removeEventListener('mouseenter', this.show);
        this.triggerTarget.removeEventListener('mouseleave', this.hide);
    }

    show() {
        if (!this.hasContentTarget) {
            return;
        }

        this.contentTarget.hidden = false;
    }

    hide() {
        if (!this.hasContentTarget) {
            return;
        }

        this.contentTarget.hidden = true;
    }
}
