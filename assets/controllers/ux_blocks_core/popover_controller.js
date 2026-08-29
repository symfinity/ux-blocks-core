import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        this.onKeydown = this.onKeydown.bind(this);
        this.onToggle = this.onToggle.bind(this);
        this.onBeforeToggle = this.onBeforeToggle.bind(this);
        this.element.addEventListener('keydown', this.onKeydown);
        this.element.addEventListener('toggle', this.onToggle);
        this.element.addEventListener('beforetoggle', this.onBeforeToggle);

        if (this.element.dataset.uiState === 'open' && typeof this.element.showPopover === 'function') {
            this.element.showPopover();
        }

        if (this.element.matches(':popover-open')) {
            this.schedulePosition();
        }
    }

    disconnect() {
        this.element.removeEventListener('keydown', this.onKeydown);
        this.element.removeEventListener('toggle', this.onToggle);
        this.element.removeEventListener('beforetoggle', this.onBeforeToggle);
    }

    onBeforeToggle(event) {
        if (event.newState === 'open') {
            this.schedulePosition();
        }
    }

    onToggle(event) {
        if (event.newState === 'open') {
            this.schedulePosition();
        }
    }

    onKeydown(event) {
        if (event.key !== 'Escape' || !this.element.matches(':popover-open')) {
            return;
        }

        this.element.hidePopover();
        this.resolveTrigger()?.focus();
    }

    schedulePosition() {
        requestAnimationFrame(() => {
            requestAnimationFrame(() => this.positionNearTrigger());
        });
    }

    positionNearTrigger() {
        if (this.usesNativeAnchorPositioning()) {
            return;
        }

        const trigger = this.resolveTrigger();
        if (!trigger) {
            return;
        }

        const rect = trigger.getBoundingClientRect();
        const popover = this.element;
        const gap = 4;

        popover.style.setProperty('position', 'fixed', 'important');
        popover.style.setProperty('margin', '0', 'important');
        popover.style.setProperty('inset', 'auto', 'important');
        popover.style.setProperty('transform', 'translateX(-50%)', 'important');

        const popoverHeight = popover.offsetHeight;
        const popoverWidth = popover.offsetWidth;

        let top = rect.bottom + gap;
        let left = rect.left + rect.width / 2;

        if (top + popoverHeight > window.innerHeight - gap) {
            top = Math.max(gap, rect.top - popoverHeight - gap);
        }

        const halfWidth = popoverWidth / 2;
        left = Math.max(halfWidth + gap, Math.min(left, window.innerWidth - halfWidth - gap));

        popover.style.setProperty('top', `${top}px`, 'important');
        popover.style.setProperty('left', `${left}px`, 'important');
    }

    usesNativeAnchorPositioning() {
        return this.element.hasAttribute('anchor')
            && typeof CSS !== 'undefined'
            && CSS.supports('top', 'anchor(bottom)');
    }

    resolveTrigger() {
        const anchorId = this.element.getAttribute('anchor');
        if (anchorId) {
            return document.getElementById(anchorId);
        }

        const popoverId = this.element.id;
        if (popoverId) {
            return document.querySelector(`[popovertarget="${CSS.escape(popoverId)}"]`);
        }

        return null;
    }
}
