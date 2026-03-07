<style>
    :root {
        --uf-bg:          #f0f2f7;
        --uf-surface:     #ffffff;
        --uf-border:      #e4e8f0;
        --uf-text:        #111827;
        --uf-muted:       #6b7280;
        --uf-subtle:      #9ca3af;
        --uf-accent:      #2563eb;
        --uf-accent-dark: #1d4ed8;
        --uf-accent-soft: #eff4ff;
        --uf-red:         #dc2626;
        --uf-red-soft:    #fef2f2;
        --uf-red-border:  #fecaca;
        --uf-radius:      14px;
        --uf-radius-sm:   9px;
        --uf-shadow:      0 4px 20px rgba(15,23,42,.08), 0 1px 4px rgba(15,23,42,.04);
        --uf-font:        'DM Sans', sans-serif;
        --uf-mono:        'DM Mono', monospace;
    }

    .uf-page {
        font-family: var(--uf-font);
        background: var(--uf-bg);
        min-height: 100vh;
        padding: 2rem 2.5rem 3.5rem;
        box-sizing: border-box;
        max-width: 720px;
    }

    .uf-back {
        display: inline-flex; align-items: center; gap: .4rem;
        font-size: .8rem; font-weight: 600;
        color: var(--uf-muted); text-decoration: none;
        margin-bottom: 1.75rem; transition: color .15s;
    }

    .uf-back:hover { color: var(--uf-accent); text-decoration: none; }

    .uf-back svg { width: 14px; height: 14px; flex-shrink: 0; }

    .uf-header {
        display: flex; align-items: flex-start; gap: 1.1rem;
        margin-bottom: 1.75rem;
        animation: fadeUp .35s ease both;
    }

    .uf-header-icon {
        width: 50px; height: 50px;
        border-radius: 13px;
        background: var(--icon-bg, #eff4ff);
        border: 1px solid var(--icon-border, #c7d9fd);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0; margin-top: .15rem;
    }

    .uf-header-icon svg {
        width: 22px; height: 22px;
        stroke: var(--icon-color, #2563eb);
    }

    .uf-eyebrow {
        font-size: .7rem; font-weight: 700;
        text-transform: uppercase; letter-spacing: .1em;
        color: var(--uf-muted); margin: 0 0 .25rem;
    }

    .uf-title {
        font-size: 1.55rem; font-weight: 700;
        color: var(--uf-text); letter-spacing: -.025em;
        line-height: 1.2; margin: 0 0 .3rem;
    }

    .uf-subtitle {
        font-size: .85rem; color: var(--uf-muted); margin: 0;
    }

    .uf-card {
        background: var(--uf-surface);
        border: 1px solid var(--uf-border);
        border-radius: var(--uf-radius);
        box-shadow: var(--uf-shadow);
        padding: 1.75rem 2rem;
        animation: fadeUp .4s ease both .06s;
    }

    /* Alert */
    .uf-alert {
        display: flex; gap: .85rem;
        background: var(--uf-red-soft);
        border: 1px solid var(--uf-red-border);
        border-radius: var(--uf-radius-sm);
        padding: .9rem 1rem;
        margin-bottom: 1.4rem;
    }

    .uf-alert-icon svg { width: 17px; height: 17px; stroke: var(--uf-red); }

    .uf-alert-title { font-size: .875rem; font-weight: 700; color: var(--uf-red); margin: 0 0 .35rem; }
    .uf-alert-list { margin: 0; padding-left: 1.1rem; }
    .uf-alert-list li { font-size: .82rem; color: #b91c1c; line-height: 1.65; }

    /* Fields */
    .uf-fields {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.25rem 1.5rem;
        margin-bottom: 1.75rem;
    }

    .uf-field { display: flex; flex-direction: column; gap: .4rem; }

    .uf-label {
        font-size: .825rem; font-weight: 700;
        color: var(--uf-text); display: flex; align-items: center; gap: .25rem;
    }

    .uf-required { color: var(--uf-red); font-size: .7rem; }
    .uf-hint { font-size: .78rem; color: var(--uf-muted); margin: 0; line-height: 1.5; }

    /* Input */
    .uf-input-wrap { position: relative; }

    .uf-input-icon {
        position: absolute; left: .8rem; top: 50%;
        transform: translateY(-50%); pointer-events: none;
        display: flex; align-items: center;
    }

    .uf-input-icon svg { width: 15px; height: 15px; stroke: var(--uf-subtle); }

    .uf-input {
        width: 100%;
        font-family: var(--uf-font);
        font-size: .875rem; color: var(--uf-text);
        background: var(--uf-bg);
        border: 1px solid var(--uf-border);
        border-radius: var(--uf-radius-sm);
        outline: none;
        padding: 0 2.5rem 0 2.4rem;
        height: 44px;
        box-sizing: border-box;
        transition: border-color .18s, box-shadow .18s, background .18s;
    }

    .uf-input::placeholder { color: #9ca3af; }

    .uf-input:focus {
        border-color: var(--uf-accent);
        box-shadow: 0 0 0 3px rgba(37,99,235,.12);
        background: #fff;
    }

    .uf-mono-input { font-family: var(--uf-mono); font-size: .85rem; }

    /* Show/hide password button */
    .uf-eye-btn {
        position: absolute; right: .75rem; top: 50%;
        transform: translateY(-50%);
        background: none; border: none; cursor: pointer; padding: 0;
        display: flex; align-items: center;
        color: var(--uf-subtle);
        transition: color .15s;
    }

    .uf-eye-btn:hover { color: var(--uf-accent); }
    .uf-eye-btn svg { width: 16px; height: 16px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }

    /* Select */
    .uf-select-wrap { position: relative; }

    .uf-select-icon {
        position: absolute; left: .8rem; top: 50%;
        transform: translateY(-50%); pointer-events: none;
        width: 15px; height: 15px; stroke: var(--uf-subtle);
    }

    .uf-chevron {
        position: absolute; right: .75rem; top: 50%;
        transform: translateY(-50%); pointer-events: none;
        width: 14px; height: 14px; stroke: var(--uf-subtle);
    }

    .uf-select {
        width: 100%;
        font-family: var(--uf-font);
        font-size: .875rem; color: var(--uf-text);
        background: var(--uf-bg);
        border: 1px solid var(--uf-border);
        border-radius: var(--uf-radius-sm);
        outline: none;
        padding: 0 2.2rem 0 2.4rem;
        height: 44px;
        box-sizing: border-box;
        appearance: none; -webkit-appearance: none;
        transition: border-color .18s, box-shadow .18s, background .18s;
        cursor: pointer;
    }

    .uf-select:focus {
        border-color: var(--uf-accent);
        box-shadow: 0 0 0 3px rgba(37,99,235,.12);
        background: #fff;
    }

    /* Error */
    .uf-field--error .uf-input,
    .uf-field--error .uf-select {
        border-color: var(--uf-red);
        background: var(--uf-red-soft);
    }

    .uf-field--error .uf-input:focus,
    .uf-field--error .uf-select:focus {
        box-shadow: 0 0 0 3px rgba(220,38,38,.12);
    }

    .uf-field-error {
        font-size: .78rem; color: var(--uf-red); font-weight: 600; margin: 0;
        display: flex; align-items: center; gap: .3rem;
    }

    .uf-field-error::before {
        content: ''; display: inline-block;
        width: 4px; height: 4px;
        background: var(--uf-red); border-radius: 50%; flex-shrink: 0;
    }

    /* Actions */
    .uf-actions {
        display: flex; align-items: center; justify-content: flex-end;
        gap: .65rem;
        padding-top: 1.4rem;
        border-top: 1px solid var(--uf-border);
    }

    .uf-btn-secondary {
        display: inline-flex; align-items: center;
        font-family: var(--uf-font); font-size: .875rem; font-weight: 600;
        padding: .6rem 1.1rem;
        border-radius: var(--uf-radius-sm);
        border: 1px solid var(--uf-border);
        background: var(--uf-bg); color: var(--uf-muted);
        text-decoration: none; cursor: pointer;
        transition: background .15s, color .15s;
    }

    .uf-btn-secondary:hover { background: #e9ecf1; color: var(--uf-text); text-decoration: none; }

    .uf-btn-primary {
        display: inline-flex; align-items: center; gap: .45rem;
        font-family: var(--uf-font); font-size: .875rem; font-weight: 600;
        padding: .6rem 1.3rem;
        border-radius: var(--uf-radius-sm); border: none;
        background: var(--uf-accent); color: #fff;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(37,99,235,.28);
        transition: background .18s, box-shadow .18s, transform .14s;
    }

    .uf-btn-primary:hover {
        background: var(--uf-accent-dark);
        box-shadow: 0 4px 14px rgba(37,99,235,.38);
        transform: translateY(-1px);
    }

    .uf-btn-primary svg { width: 15px; height: 15px; }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(12px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 767px) {
        .uf-page { padding: 1.25rem 1rem 2.5rem; }
        .uf-card { padding: 1.25rem; }
        .uf-fields { grid-template-columns: 1fr; }
        .uf-actions { flex-direction: column-reverse; }
        .uf-btn-primary, .uf-btn-secondary { width: 100%; justify-content: center; }
    }
</style>