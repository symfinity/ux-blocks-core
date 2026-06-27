#!/usr/bin/env python3
"""One-shot generator for ux-blocks-* component handbook pages (author-facing, no ## Examples)."""
from __future__ import annotations

import re
from pathlib import Path
from typing import Any

PACKAGES = {
    "ux-blocks-core": Path(__file__).resolve().parents[1],
    "ux-blocks-form": Path(__file__).resolve().parents[2] / "ux-blocks-form",
    "ux-blocks-extended": Path(__file__).resolve().parents[2] / "ux-blocks-extended",
}

# role -> (Title, twig, one_line, usage_twig, related_md_links)
CORE: dict[str, tuple[str, str, str, str, str]] = {
    "typography": ("Typography", "Typography", "Headings, body copy, and prose blocks.", '<twig:Typography as="h1">Page title</twig:Typography>', "[Button](button.md)"),
    "button": ("Button", "Button", "Primary actions and form submits.", '<twig:Button variant="primary">Save</twig:Button>', "[Link](link.md)"),
    "separator": ("Separator", "Separator", "Visual divider between sections.", "<twig:Separator />", "[Stack](stack.md)"),
    "divider": ("Divider", "Divider", "Text or rule divider for inline separation.", "<twig:Divider />", "[Separator](separator.md)"),
    "aspect-ratio": ("AspectRatio", "AspectRatio", "Locks media to a fixed width/height ratio.", '<twig:AspectRatio ratio="16/9">…</twig:AspectRatio>', "[Image](image.md)"),
    "scroll-area": ("ScrollArea", "ScrollArea", "Scrollable region with styled overflow.", "<twig:ScrollArea>…</twig:ScrollArea>", "[Stack](stack.md)"),
    "badge": ("Badge", "Badge", "Compact status or count label.", '<twig:Badge variant="success">Active</twig:Badge>', "[Button](button.md)"),
    "avatar": ("Avatar", "Avatar", "User or entity avatar (image or initials).", '<twig:Avatar alt="Alex" />', "[Badge](badge.md)"),
    "kbd": ("Kbd", "Kbd", "Keyboard shortcut hint.", "<twig:Kbd>⌘ K</twig:Kbd>", "[Button](button.md)"),
    "link": ("Link", "Link", "Inline text navigation.", '<twig:Link href="/docs">Documentation</twig:Link>', "[Button](button.md)"),
    "progress": ("Progress", "Progress", "Completion progress bar.", '<twig:Progress :value="60" />', "[Spinner](spinner.md)"),
    "spinner": ("Spinner", "Spinner", "Loading indicator.", '<twig:Spinner label="Loading" />', "[Progress](progress.md)"),
    "skeleton": ("Skeleton", "Skeleton", "Loading placeholder shape.", '<twig:Skeleton class="h-8 w-48" />', "[Spinner](spinner.md)"),
    "image": ("Image", "Image", "Responsive content image.", '<twig:Image src="/photo.jpg" alt="Team photo" />', "[Figure](figure.md)"),
    "figure": ("Figure", "Figure", "Image with optional caption.", "<twig:Figure>…</twig:Figure>", "[Image](image.md)"),
    "flash": ("Flash", "Flash", "Single inline flash message.", '<twig:Flash variant="success">Saved.</twig:Flash>', "[FlashStack](flash-stack.md)"),
    "flash-stack": ("FlashStack", "FlashStack", "Stack of flash messages.", "<twig:FlashStack>…</twig:FlashStack>", "[Flash](flash.md)"),
    "page-heading": ("PageHeading", "PageHeading", "Primary page title block.", '<twig:PageHeading title="Settings" />', "[SectionHeading](section-heading.md)"),
    "section-heading": ("SectionHeading", "SectionHeading", "Section title within a page.", '<twig:SectionHeading title="Notifications" />', "[PageHeading](page-heading.md)"),
    "grid": ("Grid", "Grid", "CSS grid layout shell.", "<twig:Grid cols=\"2\">…</twig:Grid>", "[Stack](stack.md)"),
    "stack": ("Stack", "Stack", "Vertical or horizontal stack spacing.", "<twig:Stack gap=\"md\">…</twig:Stack>", "[Grid](grid.md)"),
    "list": ("List", "List", "Styled list container.", "<twig:List>…</twig:List>", "[Stack](stack.md)"),
    "breadcrumb": ("Breadcrumb", "Breadcrumb", "Navigation breadcrumb trail.", "<twig:Breadcrumb>…</twig:Breadcrumb>", "[Link](link.md)"),
    "pagination": ("Pagination", "Pagination", "Paged navigation control.", "<twig:Pagination :page=\"1\" :total=\"10\" />", "[Button](button.md)"),
    "button-group": ("ButtonGroup", "ButtonGroup", "Grouped related buttons.", "<twig:ButtonGroup>…</twig:ButtonGroup>", "[Button](button.md)"),
}

FORM: dict[str, tuple[str, str, str, str, str]] = {
    "label": ("Label", "Label", "Accessible caption for a form control.", '<twig:Label for="email">Email</twig:Label>', "[Field](field.md)"),
    "input": ("Input", "Input", "Single-line text field.", '<twig:Input name="email" type="email" />', "[Field](field.md)"),
    "textarea": ("Textarea", "Textarea", "Multi-line text field.", '<twig:Textarea name="notes" rows="4" />', "[Field](field.md)"),
    "checkbox": ("Checkbox", "Checkbox", "Boolean choice or toggle-button style.", '<twig:Checkbox name="agree" label="I agree" />', "[Field](field.md)"),
    "radio-group": ("RadioGroup", "RadioGroup", "Single choice from a list.", '<twig:RadioGroup name="plan">…</twig:RadioGroup>', "[Radio](radio.md)"),
    "select": ("Select", "Select", "Native dropdown.", '<twig:Select name="country">…</twig:Select>', "[Field](field.md)"),
    "switch": ("Switch", "Switch", "On/off toggle.", '<twig:Switch name="notifications" label="Email alerts" />', "[Checkbox](checkbox.md)"),
    "file-input": ("FileInput", "FileInput", "Native file picker.", '<twig:FileInput name="avatar" />', "[FileUpload](file-upload.md)"),
    "input-group": ("InputGroup", "InputGroup", "Input with leading/trailing addons.", "<twig:InputGroup>…</twig:InputGroup>", "[Input](input.md)"),
    "fieldset": ("Fieldset", "Fieldset", "Grouped fields with legend.", "<twig:Fieldset legend=\"Address\">…</twig:Fieldset>", "[Field](field.md)"),
    "field": ("Field", "Field", "Label, control, hint, and error compound.", "<twig:Field label=\"Email\">…</twig:Field>", "[Input](input.md)"),
    "floating-field": ("FloatingField", "FloatingField", "Floating label wrapper for text controls.", "<twig:FloatingField label=\"Email\">…</twig:FloatingField>", "[Field](field.md)"),
    "range": ("Range", "Range", "Numeric range slider.", '<twig:Range name="volume" min="0" max="100" />', "[Input](input.md)"),
    "radio": ("Radio", "Radio", "Single radio option inside a group.", '<twig:Radio name="plan" value="pro" label="Pro" />', "[RadioGroup](radio-group.md)"),
    "form": ("Form", "Form", "Form wrapper with title and method.", '<twig:Form method="post" action="{{ path(\'app_save\') }}">…</twig:Form>', "[FormActions](form-actions.md)"),
    "form-actions": ("FormActions", "FormActions", "Submit and cancel button row.", "<twig:FormActions align=\"end\">…</twig:FormActions>", "[Form](form.md)"),
    "file-upload": ("FileUpload", "FileUpload", "Button-triggered upload with filename display.", '<twig:FileUpload name="document" />', "[FileInput](file-input.md)"),
}

EXT: dict[str, tuple[str, str, str, str, str]] = {
    "card": ("Card", "Card", "Grouped content with title and actions.", '<twig:Card title="Plan">…</twig:Card>', "[Empty](empty.md)"),
    "table": ("Table", "Table", "Data table markup and styling.", "<twig:Table>…</twig:Table>", "[DataTableChrome](data-table-chrome.md)"),
    "alert": ("Alert", "Alert", "Inline status message.", '<twig:Alert variant="success" title="Saved">…</twig:Alert>', "[Dialog](dialog.md)"),
    "description-list": ("DescriptionList", "DescriptionList", "Term/description pairs.", "<twig:DescriptionList>…</twig:DescriptionList>", "[Stat](stat.md)"),
    "stat": ("Stat", "Stat", "Statistic with label and value.", '<twig:Stat label="Users" value="1,204" />', "[DescriptionList](description-list.md)"),
    "timeline": ("Timeline", "Timeline", "Chronological event list.", "<twig:Timeline>…</twig:Timeline>", "[Card](card.md)"),
    "accordion": ("Accordion", "Accordion", "Expand/collapse FAQ panels.", "<twig:Accordion>…</twig:Accordion>", "[Card](card.md)"),
    "carousel": ("Carousel", "Carousel", "Sliding content panels.", "<twig:Carousel>…</twig:Carousel>", "[Card](card.md)"),
    "dialog": ("Dialog", "Dialog", "Modal overlay for focused tasks.", "<twig:Dialog>…</twig:Dialog>", "[Alert](alert.md)"),
    "popover": ("Popover", "Popover", "Anchored floating panel.", "<twig:Popover>…</twig:Popover>", "[Tooltip](tooltip.md)"),
    "tooltip": ("Tooltip", "Tooltip", "Hover/focus hint.", "<twig:Tooltip content=\"Help text\">…</twig:Tooltip>", "[Popover](popover.md)"),
    "navbar": ("Navbar", "Navbar", "Top navigation bar.", "<twig:Navbar>…</twig:Navbar>", "[AppShell](app-shell.md)"),
    "steps": ("Steps", "Steps", "Multi-step progress indicator.", "<twig:Steps>…</twig:Steps>", "[Form](https://docs.symfinity.dev/ux-blocks-form/components/form)"),
    "auth-layout": ("AuthLayout", "AuthLayout", "Centered sign-in/sign-up layout.", "<twig:AuthLayout>…</twig:AuthLayout>", "[Card](card.md)"),
    "dashboard-shell": ("DashboardShell", "DashboardShell", "Dashboard layout with sidebar slot.", "<twig:DashboardShell>…</twig:DashboardShell>", "[AppShell](app-shell.md)"),
    "app-shell": ("AppShell", "AppShell", "Application chrome wrapper.", "<twig:AppShell>…</twig:AppShell>", "[PageHeader](page-header.md)"),
    "page-header": ("PageHeader", "PageHeader", "Page title and description bar.", '<twig:PageHeader title="Settings" description="Manage your account." />', "[AppShell](app-shell.md)"),
    "data-table-chrome": ("DataTableChrome", "DataTableChrome", "Toolbar and filters around a table.", "<twig:DataTableChrome>…</twig:DataTableChrome>", "[Table](table.md)"),
    "empty": ("Empty", "Empty", "Zero-state placeholder.", "<twig:Empty title=\"No results\">…</twig:Empty>", "[Card](card.md)"),
    "bento-box-panel": ("BentoBoxPanel", "BentoBoxPanel", "Category link grid.", "<twig:BentoBoxPanel>…</twig:BentoBoxPanel>", "[Card](card.md)"),
    "search-form": ("SearchForm", "SearchForm", "Search field in a form shell.", '<twig:SearchForm action="/search" method="get">…</twig:SearchForm>', "[Input](https://docs.symfinity.dev/ux-blocks-form/components/input)"),
}


ROLE_CATEGORY: dict[str, str] = {
    "typography": "type",
    "button": "action",
    "separator": "layout",
    "divider": "layout",
    "aspect-ratio": "media",
    "scroll-area": "layout",
    "badge": "action",
    "avatar": "media",
    "kbd": "type",
    "link": "nav",
    "progress": "feedback",
    "spinner": "feedback",
    "skeleton": "feedback",
    "image": "media",
    "figure": "media",
    "flash": "feedback",
    "flash-stack": "feedback",
    "page-heading": "type",
    "section-heading": "type",
    "grid": "layout",
    "stack": "layout",
    "list": "layout",
    "breadcrumb": "nav",
    "pagination": "nav",
    "button-group": "action",
    "label": "form-control",
    "input": "form-control",
    "textarea": "form-control",
    "checkbox": "form-control",
    "radio-group": "form-control",
    "select": "form-control",
    "switch": "form-control",
    "file-input": "form-control",
    "input-group": "form-compound",
    "fieldset": "form-compound",
    "field": "form-compound",
    "floating-field": "form-compound",
    "range": "form-control",
    "radio": "form-control",
    "form": "form-compound",
    "form-actions": "form-compound",
    "file-upload": "form-compound",
    "card": "compound",
    "table": "compound",
    "alert": "feedback",
    "description-list": "compound",
    "stat": "compound",
    "timeline": "compound",
    "accordion": "compound",
    "carousel": "compound",
    "dialog": "overlay",
    "popover": "overlay",
    "tooltip": "overlay",
    "navbar": "shell",
    "steps": "nav",
    "auth-layout": "shell",
    "dashboard-shell": "shell",
    "app-shell": "shell",
    "page-header": "shell",
    "data-table-chrome": "compound",
    "empty": "feedback",
    "bento-box-panel": "compound",
    "search-form": "form-compound",
}

CATEGORY_GUIDANCE: dict[str, dict[str, list[str]]] = {
    "action": {
        "do": ["Use one clear primary action per view.", "Match `variant` to semantic intent (danger for destructive)."],
        "dont": ["Stack multiple primary-weight controls side by side.", "Use buttons for plain navigation when Link fits."],
        "a11y": ["Icon-only controls need `aria-label`.", "Do not rely on colour alone for meaning."],
    },
    "layout": {
        "do": ["Prefer kernel spacing tokens (`gap`, `stack`) over ad-hoc margins.", "Keep nesting shallow — compose with Stack or Grid."],
        "dont": ["Wrap every block in multiple layout shells.", "Fight the theme spacing scale with one-off pixel values."],
        "a11y": ["Preserve document heading order inside layout regions.", "Scroll areas need keyboard access to overflowing content."],
    },
    "media": {
        "do": ["Provide descriptive `alt` on informative images.", "Pick aspect ratios that match the media format."],
        "dont": ["Stretch media without a ratio or max-width constraint.", "Use decorative images without `alt=\"\"` when appropriate."],
        "a11y": ["Informative images require text alternatives.", "Avatars need meaningful labels when they identify a person."],
    },
    "feedback": {
        "do": ["Pair status colour with visible text.", "Use dismiss controls only when users can recover context."],
        "dont": ["Flash critical errors without a recovery action.", "Show loading placeholders without an eventual content swap."],
        "a11y": ["Status messages need text — not colour alone.", "Use `role=\"alert\"` for urgent errors; `role=\"status\"` for success/info."],
    },
    "nav": {
        "do": ["Mark the current page in breadcrumbs and pagination.", "Keep link text descriptive out of context."],
        "dont": ["Duplicate primary nav in breadcrumbs and navbar.", "Use `#` hrefs for real destinations."],
        "a11y": ["Current page should be indicated with `aria-current`.", "Pagination controls need discernible names."],
    },
    "type": {
        "do": ["Use one `h1` / PageHeading per view.", "Reserve muted/lead variants for hierarchy, not body copy only."],
        "dont": ["Skip heading levels for styling convenience.", "Use headings for non-structural emphasis."],
        "a11y": ["Heading order must reflect page structure.", "Kbd hints should not be the only way to discover shortcuts."],
    },
    "form-control": {
        "do": ["Associate every control with a visible label.", "Use native `type` and validation attributes first."],
        "dont": ["Rely on placeholder text instead of labels.", "Disable submit without explaining why."],
        "a11y": ["Errors must be programmatically associated with fields.", "Switches and checkboxes need explicit labels."],
    },
    "form-compound": {
        "do": ["Group related fields in Fieldset or Field compounds.", "Align FormActions with reading direction (end for LTR submit)."],
        "dont": ["Nest forms inside forms.", "Split one logical field across multiple unlabeled inputs."],
        "a11y": ["Fieldset legends describe the group purpose.", "Surface validation summary for multi-field errors."],
    },
    "compound": {
        "do": ["Keep card titles concise; actions in the header/footer slots.", "Use Empty when a list has zero rows — not a bare table."],
        "dont": ["Overload cards with more than one primary action.", "Hide essential data only in hover-only tooltips."],
        "a11y": ["Table headers must scope columns/rows correctly.", "Accordion panels need expanded/collapsed state exposed."],
    },
    "overlay": {
        "do": ["Trap focus inside modal dialogs while open.", "Return focus to the trigger on close."],
        "dont": ["Open dialogs without a user gesture unless necessary.", "Stack multiple modal layers without clear dismissal."],
        "a11y": ["Dialogs need `aria-modal` and labelled titles.", "Tooltips must not hold essential instructions only."],
    },
    "shell": {
        "do": ["Use AppShell once per application layout.", "Keep navbar items to primary destinations."],
        "dont": ["Nest full shells inside shells.", "Duplicate page titles in shell chrome and PageHeading without reason."],
        "a11y": ["Landmarks (`nav`, `main`) should be unique per page.", "Skip links help keyboard users reach main content."],
    },
    "default": {
        "do": ["Keep markup semantic and labels explicit.", "Compose with sibling components from the same tier."],
        "dont": ["Duplicate variant matrices in prose — previews below are canonical.", "Mix tiers without installing the required package."],
        "a11y": ["Provide accessible names for interactive controls.", "Do not rely on colour alone to convey state."],
    },
}

STALLION_REFS: dict[str, str] = {
    "button": "[shadcn Button](https://ui.shadcn.com/docs/components/button) · [Bootstrap buttons](https://getbootstrap.com/docs/5.3/components/buttons/)",
    "badge": "[shadcn Badge](https://ui.shadcn.com/docs/components/badge) · [Bootstrap badges](https://getbootstrap.com/docs/5.3/components/badge/)",
    "link": "[Bootstrap links](https://getbootstrap.com/docs/5.3/content/typography/#links)",
    "input": "[shadcn Input](https://ui.shadcn.com/docs/components/input)",
    "card": "[shadcn Card](https://ui.shadcn.com/docs/components/card)",
    "alert": "[shadcn Alert](https://ui.shadcn.com/docs/components/alert)",
    "dialog": "[shadcn Dialog](https://ui.shadcn.com/docs/components/dialog)",
    "accordion": "[Bootstrap accordion](https://getbootstrap.com/docs/5.3/components/accordion/)",
    "breadcrumb": "[Bootstrap breadcrumb](https://getbootstrap.com/docs/5.3/components/breadcrumb/)",
    "pagination": "[Bootstrap pagination](https://getbootstrap.com/docs/5.3/components/pagination/)",
    "progress": "[Bootstrap progress](https://getbootstrap.com/docs/5.3/components/progress/)",
    "avatar": "[shadcn Avatar](https://ui.shadcn.com/docs/components/avatar)",
    "aspect-ratio": "[Bootstrap ratio](https://getbootstrap.com/docs/5.3/helpers/ratio/)",
}


def load_role_registry(package_dir: Path) -> dict[str, dict[str, Any]]:
    path = package_dir / "config" / "ux_roles.yaml"
    if not path.is_file():
        return {}

    roles: dict[str, dict[str, Any]] = {}
    current: str | None = None

    for line in path.read_text(encoding="utf-8").splitlines():
        role_match = re.match(r"^\s+-\s+role:\s+(\S+)\s*$", line)
        if role_match:
            current = role_match.group(1)
            roles[current] = {"attributes": [], "scalar_content": [], "icon_slot": None}
            continue

        if current is None:
            continue

        attr_match = re.match(r"^\s+attributes:\s+\[(.*)\]\s*$", line)
        if attr_match:
            roles[current]["attributes"] = [
                part.strip() for part in attr_match.group(1).split(",") if part.strip()
            ]
            continue

        scalar_match = re.match(r"^\s+scalar_content:\s+\[(.*)\]\s*$", line)
        if scalar_match:
            roles[current]["scalar_content"] = [
                part.strip() for part in scalar_match.group(1).split(",") if part.strip()
            ]
            continue

        icon_match = re.match(r"^\s+position:\s+(.+)\s*$", line)
        if icon_match and isinstance(roles[current].get("icon_slot"), dict):
            roles[current]["icon_slot"]["position"] = icon_match.group(1).strip()

        if re.match(r"^\s+icon_slot:\s*$", line):
            roles[current]["icon_slot"] = {}

    return roles


def api_table(role: str, registry: dict[str, dict[str, Any]]) -> str:
    entry = registry.get(role)
    if entry is None:
        return "| Prop | Type | Default | Description |\n|------|------|---------|-------------|\n| — | — | — | See Twig component class. |"

    rows: list[str] = []
    seen_props: set[str] = set()

    def add_row(prop: str, typ: str, default: str, desc: str) -> None:
        if prop in seen_props:
            return
        seen_props.add(prop)
        rows.append(f"| `{prop}` | `{typ}` | {default} | {desc} |")

    for attr in entry.get("attributes", []) or []:
        if isinstance(attr, str):
            add_row(attr, "string", "—", "Component attribute")

    for scalar in entry.get("scalar_content", []) or []:
        if isinstance(scalar, str):
            add_row(scalar, "string?", "—", "Slot or scalar content")

    icon = entry.get("icon_slot")
    if isinstance(icon, dict) and icon and "icon" not in seen_props:
        add_row("icon", "string?", "—", "Icon slot")
        if "position" in icon:
            add_row("iconPosition", "string", "—", str(icon["position"]))

    if rows == []:
        return "| Prop | Type | Default | Description |\n|------|------|---------|-------------|\n| — | — | — | See Twig component class and package registry. |"

    header = "| Prop | Type | Default | Description |\n|------|------|---------|-------------|"
    return header + "\n" + "\n".join(rows)


def bullet_lines(items: list[str]) -> str:
    return "\n".join(f"- {item}" for item in items)


def render(role: str, meta: tuple[str, str, str, str, str], registry: dict[str, dict[str, Any]]) -> str:
    title, _twig, one_line, usage, related = meta
    category = ROLE_CATEGORY.get(role, "default")
    guidance = CATEGORY_GUIDANCE.get(category, CATEGORY_GUIDANCE["default"])
    when = f"{one_line.rstrip('.')}. Use **{title}** when this pattern fits the screen — variant previews are below."
    compare = STALLION_REFS.get(role, "")
    compare_block = f"\n\nComparable patterns: {compare}." if compare else ""

    return f"""# {title}

{one_line}

## When to use

{when}

## Guidelines

**Do**

{bullet_lines(guidance["do"])}

**Don't**

{bullet_lines(guidance["dont"])}

## Usage

```twig
{usage}
```
{compare_block}

## API Reference

{api_table(role, registry)}

## Accessibility

{bullet_lines(guidance["a11y"])}

## Related

- {related}
"""


def write_registry(package: str, registry_meta: dict[str, tuple[str, str, str, str, str]]) -> None:
    base = PACKAGES[package]
    role_registry = load_role_registry(base)
    out = base / "docs" / "components"
    out.mkdir(parents=True, exist_ok=True)
    for role, meta in registry_meta.items():
        path = out / f"{role}.md"
        path.write_text(render(role, meta, role_registry), encoding="utf-8")
        print(f"wrote {path.relative_to(base.parent)}")


def components_index(package: str, registry: dict[str, tuple[str, str, str, str, str]], blurb: str) -> None:
    rows = "\n".join(
        f"| [{m[0]}](components/{role}.md) | {m[2].split('.')[0]} |"
        for role, m in sorted(registry.items(), key=lambda x: x[0])
    )
    cross = ""
    if package == "ux-blocks-core":
        cross = """
## Related packages

| Package | Adds |
|---------|------|
| [ux-blocks-form](https://packagist.org/packages/symfinity/ux-blocks-form) | Input, Field, Select, … |
| [ux-blocks-extended](https://packagist.org/packages/symfinity/ux-blocks-extended) | Card, Alert, Dialog, … |
"""
    elif package == "ux-blocks-form":
        cross = """
## Related packages

| Package | Adds |
|---------|------|
| [ux-blocks-core](https://packagist.org/packages/symfinity/ux-blocks-core) | Button, Typography, … |
| [ux-blocks-extended](https://packagist.org/packages/symfinity/ux-blocks-extended) | Dialog, Card, … |
"""
    else:
        cross = """
Requires **ux-blocks-core** and **ux-blocks-form** for primitives inside compounds.
"""

    content = f"""# Components

{blurb}

## Handbook index

| Component | Description |
|-----------|-------------|
{rows}

{cross}
"""
    path = PACKAGES[package] / "docs" / "components.md"
    path.write_text(content, encoding="utf-8")
    print(f"wrote {path}")


RICH_CORE = {"button", "badge", "link", "flash", "progress", "avatar", "spinner", "breadcrumb"}
RICH_FORM = {"input", "field", "floating-field", "checkbox", "select", "switch"}
RICH_EXT = {"alert", "card", "accordion", "dialog", "empty", "navbar"}


def strip_examples(path: Path) -> None:
    if not path.exists():
        return
    text = path.read_text(encoding="utf-8")
    text = re.sub(r"\n## Examples\n.*?(?=\n## |\Z)", "\n", text, flags=re.S)
    path.write_text(text, encoding="utf-8")


def main() -> None:
    for role, meta in CORE.items():
        path = PACKAGES["ux-blocks-core"] / "docs" / "components" / f"{role}.md"
        if role in RICH_CORE:
            strip_examples(path)
            continue
        path.write_text(render(role, meta, load_role_registry(PACKAGES["ux-blocks-core"])), encoding="utf-8")

    for role, meta in FORM.items():
        path = PACKAGES["ux-blocks-form"] / "docs" / "components" / f"{role}.md"
        if role in RICH_FORM:
            strip_examples(path)
            continue
        path.write_text(render(role, meta, load_role_registry(PACKAGES["ux-blocks-form"])), encoding="utf-8")

    for role, meta in EXT.items():
        path = PACKAGES["ux-blocks-extended"] / "docs" / "components" / f"{role}.md"
        if role in RICH_EXT:
            strip_examples(path)
            continue
        path.write_text(render(role, meta, load_role_registry(PACKAGES["ux-blocks-extended"])), encoding="utf-8")

    components_index(
        "ux-blocks-core",
        CORE,
        "Core atoms and layout primitives. Form controls: [ux-blocks-form](https://packagist.org/packages/symfinity/ux-blocks-form).",
    )
    components_index(
        "ux-blocks-form",
        FORM,
        "Form controls and field compounds. Buttons: [ux-blocks-core](https://packagist.org/packages/symfinity/ux-blocks-core).",
    )
    components_index(
        "ux-blocks-extended",
        EXT,
        "Compound components and layout chrome.",
    )


if __name__ == "__main__":
    main()
