<style>
    /* ─── Tokens ─────────────────────────────────────── */
    :root {
        --sf-bg:          #f0f2f7;
        --sf-surface:     #ffffff;
        --sf-border:      #e4e8f0;
        --sf-text:        #111827;
        --sf-muted:       #6b7280;
        --sf-subtle:      #9ca3af;
        --sf-accent:      #2563eb;
        --sf-accent-dark: #1d4ed8;
        --sf-accent-soft: #eff4ff;
        --sf-red:         #dc2626;
        --sf-red-soft:    #fef2f2;
        --sf-red-border:  #fecaca;
        --sf-radius:      14px;
        --sf-radius-sm:   9px;
        --sf-shadow:      0 4px 20px rgba(15,23,42,.08), 0 1px 4px rgba(15,23,42,.04);
        --sf-font:        'DM Sans', sans-serif;
        --sf-mono:        'DM Mono', monospace;
    }

    /* ─── Page ───────────────────────────────────────── */
    .sf-page {
        font-family: var(--sf-font);
        background: var(--sf-bg);
        min-height: 100vh;
        padding: 2rem 2.5rem 3.5rem;
        box-sizing: border-box;
        max-width: 860px;
    }

    /* ─── Back ───────────────────────────────────────── */
    .sf-back {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        font-size: .8rem;
        font-weight: 600;
        color: var(--sf-muted);
        text-decoration: none;
        margin-bottom: 1.75rem;
        transition: color .15s;
    }

    .sf-back:hover { color: var(--sf-accent); text-decoration: none; }

    .sf-back svg {
        width: 14px; height: 14px;
        stroke: currentColor; fill: none;
        stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round;
    }

    /* ─── Header ─────────────────────────────────────── */
    .sf-header {
        display: flex;
        align-items: flex-start;
        gap: 1.1rem;
        margin-bottom: 1.75rem;
        animation: fadeUp .35s ease both;
    }

    .sf-header-icon {
        width: 50px; height: 50px;
        border-radius: 13px;
        background: var(--icon-bg, #eff4ff);
        border: 1px solid var(--icon-border, #c7d9fd);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        margin-top: .2rem;
    }

    .sf-header-icon svg {
        width: 22px; height: 22px;
        stroke: var(--icon-color, #2563eb); fill: none;
        stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
    }

    .sf-eyebrow {
        font-size: .7rem; font-weight: 700;
        text-transform: uppercase; letter-spacing: .1em;
        color: var(--sf-muted); margin: 0 0 .25rem;
    }

    .sf-title {
        font-size: 1.6rem; font-weight: 700;
        color: var(--sf-text); letter-spacing: -.025em;
        line-height: 1.2; margin: 0 0 .3rem;
    }

    .sf-subtitle {
        font-size: .85rem; color: var(--sf-muted); margin: 0;
    }

    /* ─── Card ───────────────────────────────────────── */
    .sf-card {
        background: var(--sf-surface);
        border: 1px solid var(--sf-border);
        border-radius: var(--sf-radius);
        box-shadow: var(--sf-shadow);
        padding: 2rem;
        animation: fadeUp .4s ease both .06s;
    }

    /* ─── Alert ──────────────────────────────────────── */
    .sf-alert {
        display: flex; gap: .85rem;
        background: var(--sf-red-soft);
        border: 1px solid var(--sf-red-border);
        border-radius: var(--sf-radius-sm);
        padding: 1rem 1.1rem;
        margin-bottom: 1.5rem;
    }

    .sf-alert-icon { flex-shrink: 0; margin-top: .05rem; }

    .sf-alert-icon svg {
        width: 18px; height: 18px;
        stroke: var(--sf-red); fill: none;
        stroke-width: 2; stroke-linecap: round;
    }

    .sf-alert-body { flex: 1; }

    .sf-alert-title {
        font-size: .875rem; font-weight: 700;
        color: var(--sf-red); margin: 0 0 .4rem;
    }

    .sf-alert-list {
        margin: 0; padding-left: 1.1rem;
    }

    .sf-alert-list li {
        font-size: .825rem; color: #b91c1c; line-height: 1.6;
    }

    /* ─── Fields Grid ────────────────────────────────── */
    .sf-fields {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.25rem 1.5rem;
        margin-bottom: 2rem;
    }

    .sf-field { display: flex; flex-direction: column; gap: .4rem; }
    .sf-field--full { grid-column: span 2; }

    /* ─── Label ──────────────────────────────────────── */
    .sf-label {
        font-size: .825rem; font-weight: 700;
        color: var(--sf-text); letter-spacing: .01em;
        display: flex; align-items: center; gap: .25rem;
    }

    .sf-required { color: var(--sf-red); font-size: .7rem; }

    .sf-hint {
        font-size: .78rem; color: var(--sf-muted);
        margin: 0; line-height: 1.5;
    }

    /* ─── Input ──────────────────────────────────────── */
    .sf-input-wrap { position: relative; }

    .sf-input-icon {
        position: absolute; left: .8rem; top: 50%;
        transform: translateY(-50%); pointer-events: none;
    }

    .sf-input-icon svg {
        width: 14px; height: 14px;
        stroke: var(--sf-subtle); fill: none;
        stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
        display: block;
    }

    .sf-input {
        width: 100%;
        font-family: var(--sf-font);
        font-size: .875rem; color: var(--sf-text);
        background: var(--sf-bg);
        border: 1px solid var(--sf-border);
        border-radius: var(--sf-radius-sm);
        outline: none;
        padding: 0 .9rem 0 2.35rem;
        height: 44px;
        box-sizing: border-box;
        transition: border-color .18s, box-shadow .18s, background .18s;
    }

    .sf-mono-input { font-family: var(--sf-mono); font-size: .85rem; }

    .sf-input::placeholder { color: #9ca3af; }

    .sf-input:focus {
        border-color: var(--sf-accent);
        box-shadow: 0 0 0 3px rgba(37,99,235,.12);
        background: #fff;
    }

    /* ─── Select ─────────────────────────────────────── */
    .sf-select-wrap { position: relative; }

    .sf-select-icon {
        position: absolute; left: .8rem; top: 50%;
        transform: translateY(-50%); pointer-events: none;
        width: 14px; height: 14px;
        stroke: var(--sf-subtle); fill: none;
        stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
    }

    .sf-chevron {
        position: absolute; right: .75rem; top: 50%;
        transform: translateY(-50%); pointer-events: none;
        width: 14px; height: 14px;
        stroke: var(--sf-subtle); fill: none;
        stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round;
    }

    .sf-select {
        width: 100%;
        font-family: var(--sf-font);
        font-size: .875rem; color: var(--sf-text);
        background: var(--sf-bg);
        border: 1px solid var(--sf-border);
        border-radius: var(--sf-radius-sm);
        outline: none;
        padding: 0 2.2rem 0 2.35rem;
        height: 44px;
        box-sizing: border-box;
        appearance: none; -webkit-appearance: none;
        transition: border-color .18s, box-shadow .18s, background .18s;
        cursor: pointer;
    }

    .sf-select:focus {
        border-color: var(--sf-accent);
        box-shadow: 0 0 0 3px rgba(37,99,235,.12);
        background: #fff;
    }

    /* ─── Textarea ───────────────────────────────────── */
    .sf-textarea {
        width: 100%;
        font-family: var(--sf-font);
        font-size: .875rem; color: var(--sf-text);
        background: var(--sf-bg);
        border: 1px solid var(--sf-border);
        border-radius: var(--sf-radius-sm);
        outline: none;
        padding: .75rem 1rem;
        resize: vertical; min-height: 100px;
        line-height: 1.65; box-sizing: border-box;
        transition: border-color .18s, box-shadow .18s, background .18s;
    }

    .sf-textarea::placeholder { color: #9ca3af; }

    .sf-textarea:focus {
        border-color: var(--sf-accent);
        box-shadow: 0 0 0 3px rgba(37,99,235,.12);
        background: #fff;
    }

    /* ─── Error state ────────────────────────────────── */
    .sf-field--error .sf-input,
    .sf-field--error .sf-select,
    .sf-field--error .sf-textarea {
        border-color: var(--sf-red);
        background: var(--sf-red-soft);
    }

    .sf-field--error .sf-input:focus,
    .sf-field--error .sf-select:focus,
    .sf-field--error .sf-textarea:focus {
        box-shadow: 0 0 0 3px rgba(220,38,38,.12);
    }

    .sf-field-error {
        font-size: .78rem; color: var(--sf-red);
        font-weight: 600; margin: 0;
        display: flex; align-items: center; gap: .3rem;
    }

    .sf-field-error::before {
        content: ''; display: inline-block;
        width: 4px; height: 4px;
        background: var(--sf-red); border-radius: 50%;
        flex-shrink: 0;
    }

    /* ─── Actions ────────────────────────────────────── */
    .sf-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: .65rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--sf-border);
    }

    .sf-btn-secondary {
        display: inline-flex; align-items: center;
        font-family: var(--sf-font); font-size: .875rem; font-weight: 600;
        padding: .6rem 1.15rem;
        border-radius: var(--sf-radius-sm);
        border: 1px solid var(--sf-border);
        background: var(--sf-bg); color: var(--sf-muted);
        text-decoration: none; cursor: pointer;
        transition: background .15s, border-color .15s, color .15s;
    }

    .sf-btn-secondary:hover {
        background: #e9ecf1; border-color: #c8d0dd;
        color: var(--sf-text); text-decoration: none;
    }

    .sf-btn-primary {
        display: inline-flex; align-items: center; gap: .45rem;
        font-family: var(--sf-font); font-size: .875rem; font-weight: 600;
        padding: .6rem 1.35rem;
        border-radius: var(--sf-radius-sm); border: none;
        background: var(--sf-accent); color: #fff;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(37,99,235,.28);
        transition: background .18s, box-shadow .18s, transform .14s;
    }

    .sf-btn-primary:hover {
        background: var(--sf-accent-dark);
        box-shadow: 0 4px 14px rgba(37,99,235,.38);
        transform: translateY(-1px);
    }

    .sf-btn-primary svg {
        width: 15px; height: 15px;
        stroke: currentColor; fill: none;
        stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round;
    }

    /* ─── Animation ──────────────────────────────────── */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(12px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ─── Responsive ─────────────────────────────────── */
    @media (max-width: 767px) {
        .sf-page  { padding: 1.25rem 1rem 2.5rem; }
        .sf-card  { padding: 1.25rem; }
        .sf-fields { grid-template-columns: 1fr; }
        .sf-field--full { grid-column: span 1; }
        .sf-actions { flex-direction: column-reverse; }
        .sf-btn-primary, .sf-btn-secondary { width: 100%; justify-content: center; }
    }
</style>