import { Controller } from '@hotwired/stimulus';
import { uiZIndex } from '../../utils/ui_z_index.js';

/**
 * Fallback placement when CSS anchor positioning is unavailable (older browsers / clipped hosts).
 * Base show/hide works without this controller via CSS :hover / :focus-within + anchor().
 */
export default class extends Controller {
    static targets = ['trigger', 'content'];

    connect() {
        this.onShow = this.onShow.bind(this);
        this.onHide = this.onHide.bind(this);
        this.onReposition = this.onReposition.bind(this);

        if (this.usesNativeAnchorPositioning()) {
            return;
        }

        this.element.addEventListener('mouseenter', this.onShow);
        this.element.addEventListener('mouseleave', this.onHide);
        this.element.addEventListener('focusin', this.onShow);
        this.element.addEventListener('focusout', this.onHide);
        window.addEventListener('scroll', this.onReposition, true);
        window.addEventListener('resize', this.onReposition);
    }

    disconnect() {
        this.element.removeEventListener('mouseenter', this.onShow);
        this.element.removeEventListener('mouseleave', this.onHide);
        this.element.removeEventListener('focusin', this.onShow);
        this.element.removeEventListener('focusout', this.onHide);
        window.removeEventListener('scroll', this.onReposition, true);
        window.removeEventListener('resize', this.onReposition);
    }

    onShow() {
        if (!this.hasContentTarget) {
            return;
        }

        this.contentTarget.classList.add('is-visible');
        this.positionContent();
    }

    onHide() {
        if (!this.hasContentTarget) {
            return;
        }

        this.contentTarget.classList.remove('is-visible');
    }

    onReposition() {
        if (this.hasContentTarget && this.contentTarget.classList.contains('is-visible')) {
            this.positionContent();
        }
    }

    positionContent() {
        const rect = this.triggerTarget.getBoundingClientRect();
        const content = this.contentTarget;
        const gap = 4;

        content.style.position = 'fixed';
        content.style.left = `${rect.left + rect.width / 2}px`;
        content.style.top = `${rect.top - gap}px`;
        content.style.transform = 'translate(-50%, -100%)';
        content.style.zIndex = uiZIndex('tooltip');
    }

    usesNativeAnchorPositioning() {
        return typeof CSS !== 'undefined' && CSS.supports('top', 'anchor(top)');
    }
}
