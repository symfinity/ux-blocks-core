import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static values = {
        scheme: String,
        endpoint: String,
    };

    update(event) {
        const select = event.currentTarget;
        const scheme = select.value;
        if (!scheme || !this.endpointValue) {
            this.fallbackNavigate(select);
            return;
        }

        const body = { scheme };
        if (scheme === 'auto') {
            body.systemPrefersDark = window.matchMedia?.('(prefers-color-scheme: dark)')?.matches ?? false;
        }

        fetch(this.endpointValue, {
            method: 'PATCH',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                Accept: 'application/json',
            },
            body: JSON.stringify(body),
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error('scheme update failed');
                }

                return response.json();
            })
            .then((payload) => this.apply(payload))
            .catch(() => {
                this.fallbackNavigate(select);
            });
    }

    apply(payload) {
        const style = document.getElementById('ui-kernel-theme-css');
        if (style && payload.css) {
            style.textContent = payload.css;
        }

        if (payload.themeId) {
            document.documentElement.dataset.theme = payload.themeId;
        }

        if (payload.colorScheme === 'light' || payload.colorScheme === 'dark') {
            document.documentElement.dataset.scheme = payload.colorScheme;
            document.documentElement.style.colorScheme = payload.colorScheme;
        }

        this.schemeValue = payload.scheme;
        this.element.value = payload.scheme;
    }

    fallbackNavigate(select) {
        const option = select.selectedOptions[0];
        if (option?.dataset?.url) {
            window.location.href = option.dataset.url;
            return;
        }

        select.value = this.schemeValue;
    }
}
