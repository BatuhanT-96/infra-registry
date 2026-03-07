<style>
    /* ─── Tokens ─────────────────────────────────────── */
    :root {
        --af-bg:          #f0f2f7;
        --af-surface:     #ffffff;
        --af-border:      #e4e8f0;
        --af-text:        #111827;
        --af-muted:       #6b7280;
        --af-subtle:      #9ca3af;
        --af-accent:      #2563eb;
        --af-accent-dark: #1d4ed8;
        --af-accent-soft: #eff4ff;
        --af-red:         #dc2626;
        --af-red-soft:    #fef2f2;
        --af-red-border:  #fecaca;
        --af-radius:      14px;
        --af-radius-sm:   9px;
        --af-shadow:      0 4px 20px rgba(15,23,42,.08), 0 1px 4px rgba(15,23,42,.04);
        --af-font:        'DM Sans', sans-serif;
    }

    /* ─── Page ───────────────────────────────────────── */
    .af-page {
        font-family: var(--af-font);
        background: var(--af-bg);
        min-height: 100vh;
        padding: 2rem 2.5rem 3.5rem;
        box-sizing: border-box;
        max-width: 760px;
    }

    /* ─── Back Link ──────────────────────────────────── */
    .af-back {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        font-size: .8rem;
        font-weight: 600;
        color: var(--af-muted);
        text-decoration: none;
        margin-bottom: 1.75rem;
        transition: color .15s;
    }

    .af-back:hover { color: var(--af-accent); text-decoration: none; }

    .af-back svg {
        width: 14px; height: 14px;
        stroke: currentColor; fill: none;
        stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round;
    }

    /* ─── Page Header ────────────────────────────────── */
    .af-header {
        display: flex;
        align-items: flex-start;
        gap: 1.1rem;
        margin-bottom: 1.75rem;
        animation: fadeUp .35s ease both;
    }

    .af-header-icon {
        width: 50px;
        height: 50px;
        border-radius: 13px;
        background: var(--icon-bg, #eff4ff);
        border: 1px solid var(--icon-border, #c7d9fd);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-top: .2rem;
    }

    .af-header-icon svg {
        width: 22px; height: 22px;
        stroke: var(--icon-color, #2563eb); fill: none;
        stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
    }

    .af-eyebrow {
        font-size: .7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .1em;
        color: var(--af-muted);
        margin: 0 0 .25rem;
    }

    .af-title {
        font-size: 1.6rem;
        font-weight: 700;
        color: var(--af-text);
        letter-spacing: -.025em;
        line-height: 1.2;
        margin: 0 0 .3rem;
    }

    .af-subtitle {
        font-size: .85rem;
        color: var(--af-muted);
        margin: 0;
    }

    /* ─── Card ───────────────────────────────────────── */
    .af-card {
        background: var(--af-surface);
        border: 1px solid var(--af-border);
        border-radius: var(--af-radius);
        box-shadow: var(--af-shadow);
        padding: 2rem;
        animation: fadeUp .4s ease both .06s;
    }

    /* ─── Validation Alert ───────────────────────────── */
    .af-alert {
        display: flex;
        gap: .85rem;
        background: var(--af-red-soft);
        border: 1px solid var(--af-red-border);
        border-radius: var(--af-radius-sm);
        padding: 1rem 1.1rem;
        margin-bottom: 1.5rem;
    }

    .af-alert-icon {
        flex-shrink: 0;
        margin-top: .05rem;
    }

    .af-alert-icon svg {
        width: 18px; height: 18px;
        stroke: var(--af-red); fill: none;
        stroke-width: 2; stroke-linecap: round;
    }

    .af-alert-body { flex: 1; }

    .af-alert-title {
        font-size: .875rem;
        font-weight: 700;
        color: var(--af-red);
        margin: 0 0 .4rem;
    }

    .af-alert-list {
        margin: 0;
        padding-left: 1.1rem;
    }

    .af-alert-list li {
        font-size: .825rem;
        color: #b91c1c;
        line-height: 1.6;
    }

    /* ─── Fields ─────────────────────────────────────── */
    .af-fields {
        display: flex;
        flex-direction: column;
        gap: 1.4rem;
        margin-bottom: 2rem;
    }

    .af-field { display: flex; flex-direction: column; gap: .4rem; }

    .af-label {
        font-size: .825rem;
        font-weight: 700;
        color: var(--af-text);
        letter-spacing: .01em;
        display: flex;
        align-items: center;
        gap: .25rem;
    }

    .af-required {
        color: var(--af-red);
        font-size: .7rem;
    }

    .af-hint {
        font-size: .78rem;
        color: var(--af-muted);
        margin: 0;
        line-height: 1.5;
    }

    /* Input with icon */
    .af-input-wrap {
        position: relative;
    }

    .af-input-icon {
        position: absolute;
        left: .85rem;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
    }

    .af-input-icon svg {
        width: 15px; height: 15px;
        stroke: var(--af-subtle); fill: none;
        stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
        display: block;
    }

    .af-input,
    .af-textarea {
        width: 100%;
        font-family: var(--af-font);
        font-size: .9rem;
        color: var(--af-text);
        background: var(--af-bg);
        border: 1px solid var(--af-border);
        border-radius: var(--af-radius-sm);
        outline: none;
        transition: border-color .18s, box-shadow .18s, background .18s;
        box-sizing: border-box;
    }

    .af-input {
        padding: .65rem .9rem .65rem 2.45rem;
        height: 44px;
    }

    .af-textarea {
        padding: .75rem 1rem;
        resize: vertical;
        min-height: 110px;
        line-height: 1.65;
    }

    .af-input::placeholder,
    .af-textarea::placeholder { color: #9ca3af; }

    .af-input:focus,
    .af-textarea:focus {
        border-color: var(--af-accent);
        box-shadow: 0 0 0 3px rgba(37,99,235,.12);
        background: #fff;
    }

    /* Error state */
    .af-field--error .af-input,
    .af-field--error .af-textarea {
        border-color: var(--af-red);
        background: var(--af-red-soft);
    }

    .af-field--error .af-input:focus,
    .af-field--error .af-textarea:focus {
        box-shadow: 0 0 0 3px rgba(220,38,38,.12);
    }

    .af-field-error {
        font-size: .78rem;
        color: var(--af-red);
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: .3rem;
    }

    .af-field-error::before {
        content: '';
        display: inline-block;
        width: 4px; height: 4px;
        background: var(--af-red);
        border-radius: 50%;
        flex-shrink: 0;
    }

    /* ─── Divider ────────────────────────────────────── */
    .af-divider {
        border: none;
        border-top: 1px solid var(--af-border);
        margin: 0 0 1.5rem;
    }

    /* ─── Actions ────────────────────────────────────── */
    .af-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: .65rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--af-border);
    }

    .af-btn-secondary {
        display: inline-flex;
        align-items: center;
        font-family: var(--af-font);
        font-size: .875rem;
        font-weight: 600;
        padding: .6rem 1.15rem;
        border-radius: var(--af-radius-sm);
        border: 1px solid var(--af-border);
        background: var(--af-bg);
        color: var(--af-muted);
        text-decoration: none;
        cursor: pointer;
        transition: background .15s, border-color .15s, color .15s;
    }

    .af-btn-secondary:hover {
        background: #e9ecf1;
        border-color: #c8d0dd;
        color: var(--af-text);
        text-decoration: none;
    }

    .af-btn-primary {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        font-family: var(--af-font);
        font-size: .875rem;
        font-weight: 600;
        padding: .6rem 1.35rem;
        border-radius: var(--af-radius-sm);
        border: none;
        background: var(--af-accent);
        color: #fff;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(37,99,235,.28);
        transition: background .18s, box-shadow .18s, transform .14s;
    }

    .af-btn-primary:hover {
        background: var(--af-accent-dark);
        box-shadow: 0 4px 14px rgba(37,99,235,.38);
        transform: translateY(-1px);
    }

    .af-btn-primary svg {
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
        .af-page  { padding: 1.25rem 1rem 2.5rem; }
        .af-card  { padding: 1.25rem; }
        .af-actions { flex-direction: column-reverse; }
        .af-btn-primary,
        .af-btn-secondary { width: 100%; justify-content: center; }
    }
</style>