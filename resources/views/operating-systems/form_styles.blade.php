<style>
    :root {
        --osf-bg:          #f0f2f7;
        --osf-surface:     #ffffff;
        --osf-border:      #e4e8f0;
        --osf-text:        #111827;
        --osf-muted:       #6b7280;
        --osf-subtle:      #9ca3af;
        --osf-accent:      #2563eb;
        --osf-accent-dark: #1d4ed8;
        --osf-accent-soft: #eff4ff;
        --osf-green:       #16a34a;
        --osf-red:         #dc2626;
        --osf-red-soft:    #fef2f2;
        --osf-red-border:  #fecaca;
        --osf-radius:      14px;
        --osf-radius-sm:   9px;
        --osf-shadow:      0 4px 20px rgba(15,23,42,.08), 0 1px 4px rgba(15,23,42,.04);
        --osf-font:        'DM Sans', sans-serif;
    }

    .osf-page {
        font-family: var(--osf-font);
        background: var(--osf-bg);
        min-height: 100vh;
        padding: 2rem 2.5rem 3.5rem;
        box-sizing: border-box;
        max-width: 620px;
    }

    /* Back */
    .osf-back {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        font-size: .8rem; font-weight: 600;
        color: var(--osf-muted);
        text-decoration: none;
        margin-bottom: 1.75rem;
        transition: color .15s;
    }

    .osf-back:hover { color: var(--osf-accent); text-decoration: none; }

    .osf-back svg {
        width: 14px; height: 14px; flex-shrink: 0;
    }

    /* Header */
    .osf-header {
        display: flex;
        align-items: flex-start;
        gap: 1.1rem;
        margin-bottom: 1.75rem;
        animation: fadeUp .35s ease both;
    }

    .osf-header-icon {
        width: 50px; height: 50px;
        border-radius: 13px;
        background: var(--icon-bg, #eff4ff);
        border: 1px solid var(--icon-border, #c7d9fd);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0; margin-top: .15rem;
    }

    .osf-header-icon svg {
        width: 22px; height: 22px;
        stroke: var(--icon-color, #2563eb);
    }

    .osf-eyebrow {
        font-size: .7rem; font-weight: 700;
        text-transform: uppercase; letter-spacing: .1em;
        color: var(--osf-muted); margin: 0 0 .25rem;
    }

    .osf-title {
        font-size: 1.55rem; font-weight: 700;
        color: var(--osf-text); letter-spacing: -.025em;
        line-height: 1.2; margin: 0 0 .3rem;
    }

    .osf-subtitle {
        font-size: .85rem; color: var(--osf-muted); margin: 0;
    }

    /* Card */
    .osf-card {
        background: var(--osf-surface);
        border: 1px solid var(--osf-border);
        border-radius: var(--osf-radius);
        box-shadow: var(--osf-shadow);
        padding: 1.75rem 2rem;
        animation: fadeUp .4s ease both .06s;
    }

    /* Alert */
    .osf-alert {
        display: flex; gap: .85rem;
        background: var(--osf-red-soft);
        border: 1px solid var(--osf-red-border);
        border-radius: var(--osf-radius-sm);
        padding: .9rem 1rem;
        margin-bottom: 1.4rem;
    }

    .osf-alert-icon { flex-shrink: 0; }

    .osf-alert-icon svg {
        width: 17px; height: 17px;
        stroke: var(--osf-red);
    }

    .osf-alert-title {
        font-size: .875rem; font-weight: 700;
        color: var(--osf-red); margin: 0 0 .35rem;
    }

    .osf-alert-list {
        margin: 0; padding-left: 1.1rem;
    }

    .osf-alert-list li {
        font-size: .82rem; color: #b91c1c; line-height: 1.65;
    }

    /* Fields */
    .osf-fields {
        display: flex;
        flex-direction: column;
        gap: 1.35rem;
        margin-bottom: 1.75rem;
    }

    .osf-field { display: flex; flex-direction: column; gap: .4rem; }

    .osf-label {
        font-size: .825rem; font-weight: 700;
        color: var(--osf-text); display: flex; align-items: center; gap: .25rem;
    }

    .osf-required { color: var(--osf-red); font-size: .7rem; }

    .osf-hint {
        font-size: .78rem; color: var(--osf-muted); margin: 0; line-height: 1.5;
    }

    /* Input */
    .osf-input-wrap { position: relative; }

    .osf-input-icon {
        position: absolute; left: .8rem; top: 50%;
        transform: translateY(-50%); pointer-events: none;
        display: flex; align-items: center;
    }

    .osf-input-icon svg {
        width: 15px; height: 15px;
        stroke: var(--osf-subtle);
    }

    .osf-input {
        width: 100%;
        font-family: var(--osf-font);
        font-size: .875rem; color: var(--osf-text);
        background: var(--osf-bg);
        border: 1px solid var(--osf-border);
        border-radius: var(--osf-radius-sm);
        outline: none;
        padding: 0 .9rem 0 2.4rem;
        height: 44px;
        box-sizing: border-box;
        transition: border-color .18s, box-shadow .18s, background .18s;
    }

    .osf-input::placeholder { color: #9ca3af; }

    .osf-input:focus {
        border-color: var(--osf-accent);
        box-shadow: 0 0 0 3px rgba(37,99,235,.12);
        background: #fff;
    }

    .osf-field--error .osf-input {
        border-color: var(--osf-red);
        background: var(--osf-red-soft);
    }

    .osf-field--error .osf-input:focus {
        box-shadow: 0 0 0 3px rgba(220,38,38,.12);
    }

    .osf-field-error {
        font-size: .78rem; color: var(--osf-red);
        font-weight: 600; margin: 0;
        display: flex; align-items: center; gap: .3rem;
    }

    .osf-field-error::before {
        content: ''; display: inline-block;
        width: 4px; height: 4px;
        background: var(--osf-red); border-radius: 50%; flex-shrink: 0;
    }

    /* Toggle switch */
    .osf-toggle {
        display: inline-flex;
        align-items: center;
        gap: .75rem;
        cursor: pointer;
        user-select: none;
        width: fit-content;
    }

    .osf-toggle-input {
        position: absolute;
        opacity: 0;
        width: 0; height: 0;
    }

    .osf-toggle-track {
        width: 44px; height: 24px;
        border-radius: 999px;
        background: #e2e8f0;
        border: 1px solid #d1d9e0;
        position: relative;
        transition: background .2s, border-color .2s;
        flex-shrink: 0;
    }

    .osf-toggle-thumb {
        position: absolute;
        top: 2px; left: 2px;
        width: 18px; height: 18px;
        border-radius: 50%;
        background: #fff;
        box-shadow: 0 1px 4px rgba(0,0,0,.15);
        transition: transform .2s;
    }

    .osf-toggle-input:checked ~ .osf-toggle-track {
        background: var(--osf-green);
        border-color: var(--osf-green);
    }

    .osf-toggle-input:checked ~ .osf-toggle-track .osf-toggle-thumb {
        transform: translateX(20px);
    }

    .osf-toggle-input:focus-visible ~ .osf-toggle-track {
        box-shadow: 0 0 0 3px rgba(22,163,74,.2);
    }

    .osf-toggle-label {
        font-size: .875rem; font-weight: 600; color: var(--osf-text);
    }

    /* Actions */
    .osf-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: .65rem;
        padding-top: 1.4rem;
        border-top: 1px solid var(--osf-border);
    }

    .osf-btn-secondary {
        display: inline-flex; align-items: center;
        font-family: var(--osf-font); font-size: .875rem; font-weight: 600;
        padding: .6rem 1.1rem;
        border-radius: var(--osf-radius-sm);
        border: 1px solid var(--osf-border);
        background: var(--osf-bg); color: var(--osf-muted);
        text-decoration: none; cursor: pointer;
        transition: background .15s, color .15s;
    }

    .osf-btn-secondary:hover {
        background: #e9ecf1; color: var(--osf-text); text-decoration: none;
    }

    .osf-btn-primary {
        display: inline-flex; align-items: center; gap: .45rem;
        font-family: var(--osf-font); font-size: .875rem; font-weight: 600;
        padding: .6rem 1.3rem;
        border-radius: var(--osf-radius-sm); border: none;
        background: var(--osf-accent); color: #fff;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(37,99,235,.28);
        transition: background .18s, box-shadow .18s, transform .14s;
    }

    .osf-btn-primary:hover {
        background: var(--osf-accent-dark);
        box-shadow: 0 4px 14px rgba(37,99,235,.38);
        transform: translateY(-1px);
    }

    .osf-btn-primary svg {
        width: 15px; height: 15px;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(12px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 767px) {
        .osf-page { padding: 1.25rem 1rem 2.5rem; }
        .osf-card { padding: 1.25rem; }
        .osf-actions { flex-direction: column-reverse; }
        .osf-btn-primary, .osf-btn-secondary { width: 100%; justify-content: center; }
    }
</style>