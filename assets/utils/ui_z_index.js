/**
 * Resolve ui-kernel SystemProfile z-index layers (--ui-z-* on :root).
 *
 * @param {'dropdown'|'sticky'|'fixed'|'modal-backdrop'|'modal'|'popover'|'tooltip'|'toast'} layer
 */
export function uiZIndex(layer) {
    return getComputedStyle(document.documentElement).getPropertyValue(`--ui-z-${layer}`).trim();
}
