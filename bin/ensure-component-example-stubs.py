#!/usr/bin/env python3
"""Ensure one minimal component-examples/{role}.yaml per registry role (skip existing)."""
from __future__ import annotations

from pathlib import Path

PACKAGES: dict[str, tuple[Path, dict[str, str]]] = {
    "ux-blocks-core": (
        Path(__file__).resolve().parents[1],
        {
            "typography": "Typography",
            "button": "Button",
            "separator": "Separator",
            "divider": "Divider",
            "aspect-ratio": "AspectRatio",
            "scroll-area": "ScrollArea",
            "badge": "Badge",
            "avatar": "Avatar",
            "kbd": "Kbd",
            "link": "Link",
            "progress": "Progress",
            "spinner": "Spinner",
            "skeleton": "Skeleton",
            "image": "Image",
            "figure": "Figure",
            "flash": "Flash",
            "flash-stack": "FlashStack",
            "page-heading": "PageHeading",
            "section-heading": "SectionHeading",
            "grid": "Grid",
            "stack": "Stack",
            "list": "List",
            "breadcrumb": "Breadcrumb",
            "pagination": "Pagination",
            "button-group": "ButtonGroup",
        },
    ),
    "ux-blocks-form": (
        Path(__file__).resolve().parents[2] / "ux-blocks-form",
        {
            "label": "Label",
            "input": "Input",
            "textarea": "Textarea",
            "checkbox": "Checkbox",
            "radio-group": "RadioGroup",
            "select": "Select",
            "switch": "Switch",
            "file-input": "FileInput",
            "input-group": "InputGroup",
            "fieldset": "Fieldset",
            "field": "Field",
            "floating-field": "FloatingField",
            "range": "Range",
            "radio": "Radio",
            "form": "Form",
            "form-actions": "FormActions",
            "file-upload": "FileUpload",
        },
    ),
    "ux-blocks-extended": (
        Path(__file__).resolve().parents[2] / "ux-blocks-extended",
        {
            "card": "Card",
            "table": "Table",
            "alert": "Alert",
            "description-list": "DescriptionList",
            "stat": "Stat",
            "timeline": "Timeline",
            "accordion": "Accordion",
            "carousel": "Carousel",
            "dialog": "Dialog",
            "popover": "Popover",
            "tooltip": "Tooltip",
            "navbar": "Navbar",
            "steps": "Steps",
            "auth-layout": "AuthLayout",
            "dashboard-shell": "DashboardShell",
            "app-shell": "AppShell",
            "page-header": "PageHeader",
            "data-table-chrome": "DataTableChrome",
            "empty": "Empty",
            "bento-box-panel": "BentoBoxPanel",
            "search-form": "SearchForm",
        },
    ),
}

# Rich manifests already authored — do not overwrite.
SKIP = {
    "ux-blocks-core": {"button", "badge", "link"},
    "ux-blocks-form": {"input", "floating-field"},
    "ux-blocks-extended": {"alert", "card", "accordion"},
}

# Minimal slot text for simple leaf components.
SLOT: dict[str, str] = {
    "button": "Save",
    "badge": "New",
    "link": "Docs",
    "typography": "Heading",
    "kbd": "⌘ K",
    "page-heading": "",
    "section-heading": "",
    "flash": "Saved.",
    "alert": "Message body.",
    "empty": "No items yet.",
    "card": "Card body.",
    "stat": "",
    "input": "",
    "checkbox": "I agree",
    "switch": "Enable alerts",
    "radio": "Option",
    "label": "Email",
    "progress": "",
    "spinner": "",
    "skeleton": "",
    "image": "",
    "avatar": "",
    "separator": "",
    "divider": "",
}

# Props for roles that need non-empty props to render sensibly.
PROPS: dict[str, dict[str, object]] = {
    "page-heading": {"title": "Settings"},
    "section-heading": {"title": "Notifications"},
    "flash": {"variant": "success"},
    "alert": {"variant": "info", "title": "Note"},
    "card": {"title": "Overview", "description": "Summary"},
    "stat": {"label": "Users", "value": "1,204"},
    "page-header": {"title": "Dashboard", "description": "Overview"},
    "empty": {"title": "No results"},
    "input": {"name": "email", "type": "email", "placeholder": "you@example.com"},
    "checkbox": {"name": "agree", "label": "I agree"},
    "switch": {"name": "alerts", "label": "Email alerts"},
    "radio": {"name": "plan", "value": "pro", "label": "Pro"},
    "label": {"for": "email"},
    "file-input": {"name": "avatar"},
    "range": {"name": "volume", "min": 0, "max": 100},
    "file-upload": {"name": "document"},
    "form": {"method": "post", "action": "/save"},
    "search-form": {"action": "/search", "method": "get"},
    "image": {"src": "/images/photo.jpg", "alt": "Photo"},
    "avatar": {"alt": "Alex"},
    "link": {"href": "/docs"},
    "badge": {"variant": "success"},
    "button": {"variant": "primary"},
}


def yaml_dump(role: str, twig: str, props: dict[str, object], slot: str) -> str:
    lines = [f"role: {role}", f"twig_name: {twig}", "examples:", "  - id: default", "    title: Default", "    section: Examples"]
    if props:
        lines.append("    props:")
        for k, v in props.items():
            if isinstance(v, bool):
                lines.append(f"      {k}: {'true' if v else 'false'}")
            elif isinstance(v, int):
                lines.append(f"      {k}: {v}")
            else:
                lines.append(f'      {k}: "{v}"')
    else:
        lines.append("    props: {}")
    lines.append(f'    slot_text: "{slot}"' if slot else "    slot_text: ''")
    return "\n".join(lines) + "\n"


def main() -> None:
    for pkg, (root, roles) in PACKAGES.items():
        out_dir = root / "config" / "component-examples"
        out_dir.mkdir(parents=True, exist_ok=True)
        skip = SKIP.get(pkg, set())
        for role, twig in roles.items():
            path = out_dir / f"{role}.yaml"
            if role in skip or path.exists():
                continue
            content = yaml_dump(role, twig, PROPS.get(role, {}), SLOT.get(role, "Example"))
            path.write_text(content, encoding="utf-8")
            print(f"created {path.relative_to(root.parent)}")


if __name__ == "__main__":
    main()
