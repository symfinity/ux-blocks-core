#!/usr/bin/env python3
"""Write handbook v1 component-examples/*.yaml with variant matrices (shadcn-style sections)."""
from __future__ import annotations

from pathlib import Path
from typing import Any

ROOT = Path(__file__).resolve().parents[1]
FORM = ROOT.parent / "ux-blocks-form"
EXT = ROOT.parent / "ux-blocks-extended"

PRESERVE: dict[str, set[str]] = {
    "ux-blocks-core": {"button", "badge", "link"},
    "ux-blocks-form": {"input", "floating-field"},
    "ux-blocks-extended": {"alert", "card"},
}


def ex(
    id_: str,
    title: str,
    section: str,
    props: dict[str, Any] | None = None,
    slot_text: str = "",
) -> dict[str, Any]:
    return {
        "id": id_,
        "title": title,
        "section": section,
        "props": props or {},
        "slot_text": slot_text,
    }


MANIFESTS: dict[str, dict[str, dict[str, Any]]] = {
    "ux-blocks-core": {
        "typography": {
            "twig_name": "Typography",
            "examples": [
                ex("body", "Body", "Variants", {}, "The quick brown fox jumps over the lazy dog."),
                ex("lead", "Lead", "Variants", {"variant": "lead"}, "Introductory lead paragraph."),
                ex("muted", "Muted", "Variants", {"variant": "muted"}, "Secondary supporting text."),
            ],
        },
        "separator": {
            "twig_name": "Separator",
            "examples": [
                ex("horizontal", "Horizontal", "Orientation", {"orientation": "horizontal"}),
                ex("vertical", "Vertical", "Orientation", {"orientation": "vertical"}),
            ],
        },
        "divider": {"twig_name": "Divider", "examples": [ex("default", "Default", "Examples")]},
        "aspect-ratio": {
            "twig_name": "AspectRatio",
            "examples": [
                ex("video", "16:9", "Ratios", {"ratio": "16/9"}, "Media"),
                ex("square", "1:1", "Ratios", {"ratio": "1/1"}, "Square"),
            ],
        },
        "scroll-area": {
            "twig_name": "ScrollArea",
            "examples": [ex("default", "Scrollable region", "Examples", {}, "Long content scrolls inside.")],
        },
        "avatar": {
            "twig_name": "Avatar",
            "examples": [
                ex("sm", "Small", "Sizes", {"size": "sm"}, "AB"),
                ex("md", "Default", "Sizes", {"size": "default"}, "CD"),
                ex("lg", "Large", "Sizes", {"size": "lg"}, "EF"),
            ],
        },
        "kbd": {"twig_name": "Kbd", "examples": [ex("shortcut", "Shortcut", "Examples", {}, "⌘ K")]},
        "progress": {
            "twig_name": "Progress",
            "examples": [
                ex("quarter", "25%", "Values", {"value": 25}),
                ex("three-quarter", "75%", "Values", {"value": 75}),
                ex("success", "Success", "Variants", {"variant": "success", "value": 60}),
            ],
        },
        "spinner": {
            "twig_name": "Spinner",
            "examples": [
                ex("inline", "Inline", "Sizes", {"size": "sm", "label": "Loading"}),
                ex("md", "Medium", "Sizes", {"size": "md", "label": "Saving"}),
                ex("lg", "Large", "Sizes", {"size": "lg", "label": "Processing"}),
            ],
        },
        "skeleton": {
            "twig_name": "Skeleton",
            "examples": [
                ex("line", "Text line", "Examples", {}, ""),
                ex("block", "Block", "Examples", {"variant": "block"}, ""),
            ],
        },
        "image": {
            "twig_name": "Image",
            "examples": [
                ex(
                    "fluid",
                    "Fluid",
                    "Variants",
                    {"src": "https://picsum.photos/800/450", "alt": "Landscape", "variant": "fluid"},
                ),
                ex(
                    "rounded",
                    "Rounded",
                    "Variants",
                    {"src": "https://picsum.photos/400/400", "alt": "Avatar crop", "variant": "rounded"},
                ),
            ],
        },
        "figure": {
            "twig_name": "Figure",
            "examples": [ex("default", "With caption", "Examples", {}, "Figure caption text.")],
        },
        "flash": {
            "twig_name": "Flash",
            "examples": [
                ex("info", "Info", "Variants", {"variant": "info"}, "New themes are available."),
                ex("success", "Success", "Variants", {"variant": "success"}, "Profile saved."),
                ex("warning", "Warning", "Variants", {"variant": "warning"}, "Maintenance tonight."),
                ex("danger", "Error", "Variants", {"variant": "danger"}, "Could not save changes."),
            ],
        },
        "flash-stack": {
            "twig_name": "FlashStack",
            "examples": [ex("default", "Stack", "Examples", {}, "")],
        },
        "page-heading": {
            "twig_name": "PageHeading",
            "examples": [
                ex("basic", "Title only", "Examples", {}, "Account settings"),
                ex("with-icon", "With icon", "Examples", {"icon": "lucide:settings"}, "Workspace"),
            ],
        },
        "section-heading": {
            "twig_name": "SectionHeading",
            "examples": [
                ex("basic", "Section title", "Examples", {}, "Notifications"),
                ex("with-icon", "With icon", "Examples", {"icon": "lucide:bell"}, "Alerts"),
            ],
        },
        "grid": {"twig_name": "Grid", "examples": [ex("default", "Grid shell", "Examples", {}, "")]},
        "stack": {"twig_name": "Stack", "examples": [ex("default", "Stack shell", "Examples", {}, "")]},
        "list": {"twig_name": "List", "examples": [ex("default", "List shell", "Examples", {}, "")]},
        "breadcrumb": {"twig_name": "Breadcrumb", "examples": [ex("default", "Trail", "Examples", {}, "")]},
        "pagination": {"twig_name": "Pagination", "examples": [ex("default", "Pager", "Examples", {}, "")]},
        "button-group": {
            "twig_name": "ButtonGroup",
            "examples": [ex("default", "Grouped actions", "Examples", {}, "")],
        },
    },
    "ux-blocks-form": {
        "label": {
            "twig_name": "Label",
            "examples": [ex("default", "Field label", "Examples", {"for": "email"}, "Email address")],
        },
        "textarea": {
            "twig_name": "Textarea",
            "examples": [
                ex("default", "Default", "Examples", {"name": "notes", "placeholder": "Add a comment…"}),
                ex("invalid", "Invalid", "States", {"name": "notes", "invalid": True}),
            ],
        },
        "checkbox": {
            "twig_name": "Checkbox",
            "examples": [
                ex("control", "Checkbox", "Appearances", {"name": "agree", "label": "I agree to the terms"}),
                ex(
                    "button",
                    "Toggle button",
                    "Appearances",
                    {"name": "plan", "appearance": "button", "label": "Pro plan", "variant": "primary"},
                ),
            ],
        },
        "radio-group": {
            "twig_name": "RadioGroup",
            "examples": [
                ex(
                    "default",
                    "Plan choice",
                    "Examples",
                    {"name": "plan", "appearance": "button", "variant": "primary"},
                    "",
                ),
            ],
        },
        "select": {
            "twig_name": "Select",
            "examples": [
                ex("default", "Country", "Examples", {"name": "country", "placeholder": "Choose…"}),
                ex("invalid", "Invalid", "States", {"name": "country", "invalid": True}),
            ],
        },
        "switch": {
            "twig_name": "Switch",
            "examples": [
                ex("default", "Notifications", "Examples", {"name": "alerts", "label": "Email alerts"}),
            ],
        },
        "file-input": {
            "twig_name": "FileInput",
            "examples": [ex("default", "Avatar upload", "Examples", {"name": "avatar"})],
        },
        "input-group": {
            "twig_name": "InputGroup",
            "examples": [ex("default", "With addon", "Examples", {}, "")],
        },
        "fieldset": {
            "twig_name": "Fieldset",
            "examples": [ex("default", "Address group", "Examples", {}, "")],
        },
        "field": {
            "twig_name": "Field",
            "examples": [
                ex("default", "With hint", "Examples", {"label": "Email", "hint": "We never share your email."}, ""),
                ex("error", "With error", "States", {"label": "Email", "error": "Invalid email", "invalid": True}, ""),
            ],
        },
        "range": {
            "twig_name": "Range",
            "examples": [ex("default", "Volume", "Examples", {"name": "volume", "min": 0, "max": 100})],
        },
        "radio": {
            "twig_name": "Radio",
            "examples": [
                ex("default", "Single option", "Examples", {"name": "plan", "value": "pro", "label": "Pro"}),
            ],
        },
        "form": {
            "twig_name": "Form",
            "examples": [
                ex("post", "POST form", "Examples", {"method": "post", "action": "/save", "title": "Profile"}, ""),
            ],
        },
        "form-actions": {
            "twig_name": "FormActions",
            "examples": [ex("end", "End aligned", "Examples", {"align": "end"}, "")],
        },
        "file-upload": {
            "twig_name": "FileUpload",
            "examples": [ex("default", "Document", "Examples", {"name": "document"})],
        },
    },
    "ux-blocks-extended": {
        "table": {"twig_name": "Table", "examples": [ex("default", "Data table", "Examples", {}, "")]},
        "description-list": {
            "twig_name": "DescriptionList",
            "examples": [ex("default", "Term list", "Examples", {}, "")],
        },
        "stat": {
            "twig_name": "Stat",
            "examples": [
                ex("users", "Users", "Examples", {"label": "Active users", "value": "1,204"}),
                ex("revenue", "Revenue", "Examples", {"label": "MRR", "value": "€12.4k"}),
            ],
        },
        "timeline": {"twig_name": "Timeline", "examples": [ex("default", "Events", "Examples", {}, "")]},
        "accordion": {
            "twig_name": "Accordion",
            "examples": [
                ex("single", "FAQ", "Examples", {"type": "single"}, ""),
            ],
        },
        "carousel": {"twig_name": "Carousel", "examples": [ex("default", "Slides", "Examples", {}, "")]},
        "dialog": {
            "twig_name": "Dialog",
            "examples": [
                ex("closed", "Closed", "States", {"open": False, "label": "Confirm delete"}),
                ex("open", "Open", "States", {"open": True, "label": "Confirm delete"}, "Are you sure?"),
            ],
        },
        "popover": {"twig_name": "Popover", "examples": [ex("default", "Anchored panel", "Examples", {}, "")]},
        "tooltip": {
            "twig_name": "Tooltip",
            "examples": [ex("default", "Hint", "Examples", {}, "Hover target")],
        },
        "navbar": {"twig_name": "Navbar", "examples": [ex("default", "Top nav", "Examples", {}, "")]},
        "steps": {"twig_name": "Steps", "examples": [ex("default", "Wizard steps", "Examples", {}, "")]},
        "auth-layout": {
            "twig_name": "AuthLayout",
            "examples": [ex("sign-in", "Sign in", "Examples", {}, "")],
        },
        "dashboard-shell": {
            "twig_name": "DashboardShell",
            "examples": [ex("default", "Dashboard chrome", "Examples", {}, "")],
        },
        "app-shell": {"twig_name": "AppShell", "examples": [ex("default", "App chrome", "Examples", {}, "")]},
        "page-header": {
            "twig_name": "PageHeader",
            "examples": [
                ex(
                    "basic",
                    "Title and description",
                    "Examples",
                    {"title": "Settings", "description": "Manage your account."},
                ),
            ],
        },
        "data-table-chrome": {
            "twig_name": "DataTableChrome",
            "examples": [ex("default", "Table toolbar", "Examples", {}, "")],
        },
        "empty": {
            "twig_name": "Empty",
            "examples": [
                ex("default", "No results", "Examples", {"title": "No projects yet"}, "Create your first project."),
            ],
        },
        "bento-box-panel": {
            "twig_name": "BentoBoxPanel",
            "examples": [ex("default", "Category grid", "Examples", {}, "")],
        },
        "search-form": {
            "twig_name": "SearchForm",
            "examples": [
                ex("get", "GET search", "Examples", {"action": "/search", "method": "get"}, ""),
            ],
        },
    },
}


def _yaml_value(value: Any) -> str:
    if isinstance(value, bool):
        return "true" if value else "false"
    if isinstance(value, int):
        return str(value)
    return f'"{value}"'


def render_manifest(role: str, spec: dict[str, Any]) -> str:
    lines = [f"role: {role}", f"twig_name: {spec['twig_name']}", "examples:"]
    for row in spec["examples"]:
        lines.append(f"  - id: {row['id']}")
        lines.append(f"    title: {row['title']}")
        lines.append(f"    section: {row['section']}")
        props = row.get("props") or {}
        if props:
            lines.append("    props:")
            for key, value in props.items():
                lines.append(f"      {key}: {_yaml_value(value)}")
        else:
            lines.append("    props: {}")
        slot = row.get("slot_text", "")
        if slot:
            escaped = slot.replace("\\", "\\\\").replace('"', '\\"')
            lines.append(f'    slot_text: "{escaped}"')
        else:
            lines.append("    slot_text: ''")
    return "\n".join(lines) + "\n"


def write_package(package_key: str, package_root: Path) -> None:
    preserve = PRESERVE.get(package_key, set())
    out_dir = package_root / "config" / "component-examples"
    out_dir.mkdir(parents=True, exist_ok=True)
    for role, spec in MANIFESTS[package_key].items():
        if role in preserve:
            continue
        path = out_dir / f"{role}.yaml"
        path.write_text(render_manifest(role, spec), encoding="utf-8")
        print(f"wrote {path.relative_to(package_root.parent)}")


def main() -> None:
    write_package("ux-blocks-core", ROOT)
    write_package("ux-blocks-form", FORM)
    write_package("ux-blocks-extended", EXT)


if __name__ == "__main__":
    main()
