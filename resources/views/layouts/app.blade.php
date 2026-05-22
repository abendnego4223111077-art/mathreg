<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MathReg</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #020617;
            color: white;
        }

        a {
            text-decoration: none;
        }

        .topbar {
            height: 60px;
            background: #020b17;
            border-bottom: 1px solid #102033;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
        }

        .brand {
            font-size: 22px;
            font-weight: bold;
            color: #22d3ee;
        }

        .user-area {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .timer {
            color: #2dd4bf;
            font-weight: bold;
        }

        .timer.expired {
            color: #f87171;
        }

        .group-name,
        .group-badge {
            font-size: .68rem;
            color: var(--gold, #fbf1d8);
            font-weight: 700;
            background: rgba(251, 191, 36, .1);
            border: 1px solid rgba(251, 191, 36, .2);
            padding: .12rem .6rem;
            border-radius: 50px;
            display: inline-block;
            white-space: nowrap;
        }

        .username {
            color: #cbd5e1;
            font-size: 14px;
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #6366f1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
        }

        .logout-btn {
            background: #ef4444;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        .stepbar {
            background: #071426;
            border-bottom: 1px solid #102033;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px 28px;
            overflow-x: auto;
        }

        .step-item {
            padding: 8px 12px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: bold;
            white-space: nowrap;
        }

        .step-item.done {
            background: rgba(20, 184, 166, 0.18);
            color: #2dd4bf;
        }

        .step-item.active {
            background: #0ea5e9;
            color: white;
        }

        .step-item.locked {
            background: rgba(148, 163, 184, 0.12);
            color: #64748b;
        }

        .page {
            max-width: 1000px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .hero-card {
            background: linear-gradient(135deg, #0f172a, #111827);
            border: 1px solid #1e293b;
            border-radius: 24px;
            padding: 36px;
            margin-bottom: 28px;
            position: relative;
            overflow: hidden;
        }

        .badge {
            display: inline-block;
            padding: 7px 14px;
            border-radius: 999px;
            background: rgba(34, 211, 238, 0.15);
            color: #67e8f9;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 1px;
            margin-bottom: 14px;
        }

        .hero-card h1 {
            margin: 0 0 10px;
            font-size: 34px;
            color: white;
        }

        .hero-card p {
            color: #94a3b8;
            font-size: 16px;
        }

        .content-card {
            background: #0f172a;
            border: 1px solid #1e293b;
            border-radius: 20px;
            padding: 24px;
        }

        .objective-item {
            background: rgba(15, 23, 42, 0.95);
            border: 1px solid #1e293b;
            border-radius: 16px;
            padding: 18px;
            display: flex;
            gap: 16px;
            align-items: flex-start;
            margin-bottom: 14px;
        }

        .number {
            background: #22d3ee;
            color: #020617;
            width: 34px;
            height: 34px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            flex-shrink: 0;
        }

        .objective-text {
            color: #e5e7eb;
            line-height: 1.5;
        }

        .btn-next {
            display: inline-block;
            margin-top: 24px;
            background: linear-gradient(90deg, #22d3ee, #14b8a6);
            color: #001;
            padding: 14px 22px;
            border-radius: 12px;
            font-weight: bold;
        }

        .button-row {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 24px;
        }

        .scard {
            background: rgba(15, 23, 42, 0.95);
            border: 1px solid #1e293b;
            border-radius: 20px;
            padding: 24px;
            position: relative;
            margin-bottom: 24px;
        }

        .s-bg-num {
            position: absolute;
            top: 18px;
            right: 18px;
            font-size: 72px;
            color: rgba(34, 211, 238, 0.12);
            font-weight: bold;
            pointer-events: none;
        }

        .stag {
            display: inline-block;
            margin-bottom: 12px;
            color: #22d3ee;
            font-weight: bold;
        }

        .stitle {
            font-size: 24px;
            margin: 0 0 10px;
            color: white;
        }

        .sdesc {
            color: #cbd5e1;
            margin: 0 0 20px;
            line-height: 1.6;
        }

        .pt-ctrl {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
            margin-bottom: 20px;
        }

        .pt-ctrl-lbl {
            font-size: 14px;
            color: #94a3b8;
            margin-right: 8px;
            min-width: 80px;
        }

        .ptbtn,
        .btn-ghost {
            border: 1px solid rgba(148, 163, 184, 0.3);
            border-radius: 12px;
            padding: 10px 14px;
            background: #0f172a;
            color: #e2e8f0;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.2s ease;
        }

        .ptbtn:hover:not(:disabled),
        .btn-ghost:hover {
            background: rgba(34, 211, 238, 0.1);
            border-color: #22d3ee;
        }

        .ptbtn:disabled {
            opacity: 0.45;
            cursor: not-allowed;
        }

        .cv-wrap {
            background: #020617;
            border: 1px solid #1e293b;
            border-radius: 18px;
            padding: 14px;
        }

        .dvr {
            height: 1px;
            background: #1e293b;
            margin-top: 22px;
        }

        .scatter-form {
            margin-top: 24px;
        }

        .alert-success {
            background: rgba(34,197,94,0.14);
            border: 1px solid rgba(34,197,94,0.4);
            color: #86efac;
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 20px;
        }
        .alert-error {
    background: rgba(239, 68, 68, 0.12);
    border: 1px solid rgba(239, 68, 68, 0.4);
    color: #fca5a5;
    padding: 12px 16px;
    border-radius: 12px;
    margin-bottom: 20px;
}

.question-block {
    display: flex;
    gap: 18px;
    padding: 22px;
    background: rgba(15, 23, 42, 0.95);
    border: 1px solid #1e293b;
    border-radius: 18px;
    margin-bottom: 18px;
}

.question-number {
    width: 38px;
    height: 38px;
    border-radius: 12px;
    background: #22d3ee;
    color: #020617;
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: bold;
    flex-shrink: 0;
}

.question-content {
    width: 100%;
}

.question-content h3 {
    margin: 0 0 8px;
    color: #e5e7eb;
}

.hint {
    color: #94a3b8;
    margin-bottom: 12px;
}

textarea {
    width: 100%;
    background: #111827;
    color: white;
    border: 1px solid #334155;
    border-radius: 14px;
    padding: 14px;
    resize: vertical;
    outline: none;
    font-family: Arial, sans-serif;
    font-size: 15px;
}

textarea:focus {
    border-color: #22d3ee;
    box-shadow: 0 0 0 3px rgba(34, 211, 238, 0.15);
}

.btn-submit {
    width: 100%;
    margin-top: 10px;
    background: linear-gradient(90deg, #22d3ee, #14b8a6);
    color: #001;
    border: none;
    padding: 15px 22px;
    border-radius: 14px;
    font-weight: bold;
    cursor: pointer;
    font-size: 15px;
}

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border-radius: 14px;
        padding: 12px 18px;
        border: 1px solid transparent;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-sm {
        padding: 8px 12px;
        font-size: 13px;
    }

    .btn-lg {
        padding: 14px 20px;
        font-size: 15px;
    }

    .btn-block {
        width: 100%;
    }

    .btn-teal {
        background: #14b8a6;
        color: #020617;
        border-color: rgba(20, 184, 166, .4);
    }

    .btn-sky {
        background: #0ea5e9;
        color: #020617;
        border-color: rgba(14, 165, 233, .4);
    }

    .btn-ghost {
        background: rgba(15, 23, 42, 0.95);
        color: #cbd5e1;
        border-color: rgba(148, 163, 184, 0.3);
    }

    .btn:hover {
        opacity: 0.95;
    }

    .presentation-wizard {
        display: grid;
        gap: 22px;
    }

    .steps-pill {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 16px;
    }

    .step-pill {
        background: #0f172a;
        border: 1px solid #334155;
        color: #cbd5e1;
        padding: 10px 14px;
        border-radius: 999px;
        cursor: pointer;
        font-size: 14px;
    }

    .step-pill.active {
        background: #22d3ee;
        color: #020617;
        border-color: #22d3ee;
    }

    .sub-page {
        display: none;
    }

    .sub-page.active {
        display: block;
    }

    .ph {
        border-radius: 20px;
        padding: 22px;
        margin-bottom: 18px;
        color: #e5e7eb;
    }

    .ph-tag {
        font-weight: 700;
        margin-bottom: 10px;
        display: inline-block;
    }

    .ph-title {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .ph-sub {
        color: #cbd5e1;
        line-height: 1.7;
    }

    .gcard {
        background: #0f172a;
        border: 1px solid #1e293b;
        border-radius: 20px;
        overflow: hidden;
        margin-bottom: 18px;
    }

    .gcard-head {
        padding: 18px 20px;
        border-bottom: 1px solid #1e293b;
    }

    .gcard-title {
        font-weight: 700;
        color: #e5e7eb;
    }

    .gcard-body {
        padding: 20px;
    }

    .fgroup {
        margin-bottom: 18px;
    }

    .flabel {
        display: block;
        margin-bottom: 8px;
        font-weight: 700;
        color: #cbd5e1;
        font-size: 14px;
    }

    .finput {
        width: 100%;
        background: #111827;
        border: 1px solid #334155;
        border-radius: 16px;
        padding: 16px;
        color: #ffffff;
        font-size: 15px;
        resize: vertical;
        min-height: 110px;
    }

    .finput:focus {
        outline: none;
        border-color: #22d3ee;
        box-shadow: 0 0 0 3px rgba(34, 211, 238, 0.12);
    }

    .clue-counter {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 18px 20px;
        background: rgba(15, 23, 42, 0.9);
        border: 1px solid #1e293b;
        border-radius: 18px;
        margin-bottom: 18px;
    }

    .clue-counter .cc-label {
        font-weight: 700;
        color: #e2e8f0;
    }

    .cc-dots {
        display: flex;
        gap: 6px;
        margin-left: auto;
    }

    .cc-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(148, 163, 184, 0.3);
    }

    .cc-dot.active {
        background: #22d3ee;
        box-shadow: 0 0 0 3px rgba(34, 211, 238, 0.12);
    }

    .clue-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    .clue-card {
        background: #111827;
        border: 1px solid #263244;
        border-radius: 18px;
        cursor: pointer;
        transition: transform 0.2s ease, border-color 0.2s ease;
        min-height: 120px;
        padding: 18px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .clue-card:hover {
        transform: translateY(-2px);
        border-color: #22d3ee;
    }

    .clue-card.opened {
        border-color: #22d3ee;
        background: rgba(34, 211, 238, 0.06);
    }

    .clue-card h4 {
        margin: 0 0 10px;
        color: #e5e7eb;
        font-size: 16px;
    }

    .clue-card p {
        margin: 0;
        color: #94a3b8;
        font-size: 14px;
        line-height: 1.6;
    }

    .clue-card small {
        color: rgba(255,255,255,.45);
        display: block;
        margin-top: 12px;
        font-size: 12px;
    }

    .presentation-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    @media (max-width: 900px) {
        .presentation-grid,
        .clue-grid {
            grid-template-columns: 1fr;
        }
    }


.group-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 18px;
}

.group-card {
    background: #111827;
    border: 1px solid #263244;
    border-radius: 18px;
    padding: 20px;
}

.group-card.selected {
    border-color: #22d3ee;
    box-shadow: 0 0 0 3px rgba(34, 211, 238, 0.12);
    background: rgba(8, 47, 73, 0.45);
}

.group-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
}

.group-header h3 {
    margin: 0;
    color: #e5e7eb;
}

.joined-badge {
    background: rgba(34, 197, 94, 0.18);
    border: 1px solid rgba(34, 197, 94, 0.45);
    color: #86efac;
    padding: 5px 10px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: bold;
}

.member-count {
    color: #94a3b8;
    margin-top: 12px;
}

.progress-track {
    height: 8px;
    background: #1f2937;
    border-radius: 999px;
    overflow: hidden;
    margin-top: 12px;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, #22d3ee, #14b8a6);
    border-radius: 999px;
}

.members-section {
    margin-top: 30px;
    background: rgba(15, 23, 42, 0.9);
    border: 1px solid #1e293b;
    padding: 20px;
    border-radius: 18px;
}

.members-section h2 {
    margin-top: 0;
    color: #e5e7eb;
}

.member-list {
    display: grid;
    gap: 10px;
}

.member-item {
    display: flex;
    align-items: center;
    gap: 12px;
    background: rgba(30, 41, 59, 0.7);
    padding: 12px;
    border-radius: 12px;
    color: #e5e7eb;
}

.mini-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #6366f1;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    flex-shrink: 0;
}

.modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(2, 6, 23, 0.88);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 999;
    padding: 20px;
}

.modal-box {
    width: 460px;
    max-width: 100%;
    background: linear-gradient(135deg, #0f172a, #111827);
    border: 1px solid #1e293b;
    border-radius: 24px;
    padding: 28px;
    position: relative;
    box-shadow: 0 30px 80px rgba(0, 0, 0, 0.35);
    animation: modalPop 0.25s ease;
}

.modal-close {
    position: absolute;
    top: 16px;
    right: 16px;
    background: #1f2937;
    color: white;
    border: none;
    width: 32px;
    height: 32px;
    border-radius: 999px;
    cursor: pointer;
    font-size: 18px;
}

.modal-icon {
    font-size: 46px;
    text-align: center;
    margin-bottom: 10px;
}

.modal-box h2 {
    text-align: center;
    color: #22d3ee;
    margin-bottom: 8px;
}

.modal-box p {
    text-align: center;
    color: #cbd5e1;
}

.modal-members {
    margin: 20px 0;
}

.modal-members h3 {
    color: #e5e7eb;
    margin-bottom: 12px;
}

@keyframes modalPop {
    from {
        opacity: 0;
        transform: scale(0.92);
    }

    to {
        opacity: 1;
        transform: scale(1);
    }
}

@media (max-width: 700px) {
    .group-grid {
        grid-template-columns: 1fr;
    }
}
.scenario-box {
    background: linear-gradient(135deg, rgba(8, 47, 73, 0.7), rgba(15, 23, 42, 0.95));
    border: 1px solid #1e3a5f;
    border-radius: 22px;
    padding: 26px;
    margin-bottom: 28px;
}

.scenario-label {
    display: inline-block;
    background: rgba(34, 211, 238, 0.14);
    color: #67e8f9;
    padding: 7px 13px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: bold;
    letter-spacing: 1px;
    margin-bottom: 12px;
}

.scenario-box h2 {
    margin: 0 0 14px;
    color: #e5e7eb;
    font-size: 26px;
}

.scenario-box p {
    color: #cbd5e1;
    line-height: 1.7;
}

.big-question {
    margin-top: 20px;
    background: rgba(250, 204, 21, 0.12);
    border: 1px solid rgba(250, 204, 21, 0.35);
    color: #fde68a;
    padding: 18px;
    border-radius: 16px;
    font-weight: bold;
    line-height: 1.6;
}

.section-title {
    margin: 28px 0 16px;
}

.section-title h2 {
    margin: 0 0 6px;
    color: #e5e7eb;
}

.section-title p {
    margin: 0;
    color: #94a3b8;
}

.table-wrapper {
    overflow-x: auto;
    border-radius: 18px;
    border: 1px solid #1e293b;
    margin-bottom: 24px;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
    background: #111827;
}

.data-table th {
    background: #0f172a;
    color: #67e8f9;
    text-align: left;
    padding: 15px;
    border-bottom: 1px solid #1e293b;
}

.data-table td {
    color: #e5e7eb;
    padding: 15px;
    border-bottom: 1px solid #1e293b;
}

.data-table tr:last-child td {
    border-bottom: none;
}

.data-table tr:hover td {
    background: rgba(34, 211, 238, 0.06);
}

.concept-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 16px;
}

.concept-card {
    background: #111827;
    border: 1px solid #263244;
    border-radius: 18px;
    padding: 20px;
}

.concept-card h3 {
    margin: 0 0 10px;
    color: #22d3ee;
}

.concept-card p {
    margin: 0;
    color: #cbd5e1;
    line-height: 1.6;
}

@media (max-width: 700px) {
    .concept-grid {
        grid-template-columns: 1fr;
    }
}
.form-group {
    margin-bottom: 18px;
}

.form-group label {
    display: block;
    color: #cbd5e1;
    font-weight: bold;
    margin-bottom: 8px;
}

.gallery-card {
    margin-top: 28px;
}

.empty-state {
    background: rgba(148, 163, 184, 0.08);
    border: 1px dashed #334155;
    color: #94a3b8;
    padding: 24px;
    border-radius: 16px;
    text-align: center;
}

.presentation-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 18px;
}

.presentation-card {
    background: #111827;
    border: 1px solid #263244;
    border-radius: 20px;
    padding: 22px;
}

.presentation-card.my-group-card {
    border-color: #22d3ee;
    box-shadow: 0 0 0 3px rgba(34, 211, 238, 0.12);
    background: rgba(8, 47, 73, 0.35);
}

.presentation-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 14px;
    margin-bottom: 16px;
}

.presentation-header h3 {
    margin: 0;
    color: #22d3ee;
}

.presentation-section {
    margin-bottom: 16px;
}

.presentation-section h4 {
    margin: 0 0 7px;
    color: #e5e7eb;
    font-size: 14px;
    letter-spacing: 0.5px;
}

.presentation-section p {
    margin: 0;
    color: #cbd5e1;
    line-height: 1.6;
}

.like-row {
    margin-top: 18px;
    padding-top: 14px;
    border-top: 1px solid #263244;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #94a3b8;
}

.like-btn {
    background: rgba(59, 130, 246, 0.18);
    border: 1px solid rgba(59, 130, 246, 0.45);
    color: #93c5fd;
    padding: 9px 14px;
    border-radius: 999px;
    cursor: pointer;
    font-weight: bold;
}

.like-btn:hover {
    background: rgba(59, 130, 246, 0.28);
}

.like-btn.liked {
    background: rgba(34, 197, 94, 0.15);
    border-color: rgba(34, 197, 94, 0.45);
    color: #86efac;
    cursor: not-allowed;
}

@media (max-width: 800px) {
    .presentation-grid {
        grid-template-columns: 1fr;
    }
}
.concept-list {
    display: grid;
    gap: 16px;
}

.concept-row {
    background: #111827;
    border: 1px solid #263244;
    border-radius: 18px;
    padding: 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    cursor: pointer;
    transition: 0.2s ease;
}

.concept-row:hover {
    border-color: #22d3ee;
    background: rgba(8, 47, 73, 0.35);
    transform: translateY(-2px);
}

.concept-left {
    display: flex;
    align-items: center;
    gap: 16px;
}

.concept-icon {
    width: 46px;
    height: 46px;
    border-radius: 14px;
    background: rgba(34, 211, 238, 0.12);
    border: 1px solid rgba(34, 211, 238, 0.35);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    flex-shrink: 0;
}

.concept-row h3 {
    margin: 0 0 6px;
    color: #e5e7eb;
}

.concept-row p {
    margin: 0;
    color: #94a3b8;
    line-height: 1.5;
}

.plus-btn {
    width: 38px;
    height: 38px;
    border-radius: 999px;
    border: none;
    background: linear-gradient(90deg, #22d3ee, #14b8a6);
    color: #001;
    font-size: 24px;
    font-weight: bold;
    cursor: pointer;
    flex-shrink: 0;
}

.concept-modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(2, 6, 23, 0.88);
    backdrop-filter: blur(6px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 999;
    padding: 20px;
}

.concept-modal-box {
    width: 760px;
    max-width: 100%;
    max-height: 90vh;
    overflow-y: auto;
    background: linear-gradient(135deg, #0f172a, #020617);
    border: 1px solid #1e293b;
    border-radius: 26px;
    padding: 30px;
    position: relative;
    box-shadow: 0 30px 90px rgba(0, 0, 0, 0.45);
    animation: modalPop 0.25s ease;
}

.concept-modal-close {
    position: absolute;
    top: 18px;
    right: 18px;
    width: 34px;
    height: 34px;
    border-radius: 999px;
    border: none;
    background: #1f2937;
    color: white;
    cursor: pointer;
    font-size: 20px;
}

.concept-modal-header {
    display: flex;
    align-items: center;
    gap: 18px;
    padding-right: 40px;
    margin-bottom: 22px;
}

.concept-modal-icon {
    width: 60px;
    height: 60px;
    border-radius: 18px;
    background: rgba(34, 211, 238, 0.12);
    border: 1px solid rgba(34, 211, 238, 0.35);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 30px;
    flex-shrink: 0;
}

.concept-modal-header h2 {
    margin: 0 0 6px;
    color: #22d3ee;
}

.concept-modal-header p {
    margin: 0;
    color: #94a3b8;
}

.modal-body > p {
    color: #cbd5e1;
    line-height: 1.7;
    margin-bottom: 20px;
}

.single-formula-box {
    background: rgba(250, 204, 21, 0.1);
    border: 1px solid rgba(250, 204, 21, 0.35);
    border-radius: 18px;
    padding: 24px;
    text-align: center;
    margin: 20px 0;
}

.single-formula-box h3 {
    margin: 0;
    color: #facc15;
    font-size: 30px;
    letter-spacing: 1px;
}

.single-formula-box p {
    margin: 10px 0 0;
    color: #fde68a;
}

.formula-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 18px;
    margin: 22px 0;
}

.formula-card {
    background: rgba(250, 204, 21, 0.1);
    border: 1px solid rgba(250, 204, 21, 0.35);
    border-radius: 18px;
    padding: 22px;
    text-align: center;
}

.formula-card h3 {
    margin: 0;
    color: #facc15;
    font-size: 18px;
    line-height: 1.5;
}

.formula-card p {
    margin: 10px 0 0;
    color: #fde68a;
    line-height: 1.5;
}

.modal-note {
    background: rgba(15, 23, 42, 0.9);
    border: 1px solid #263244;
    border-radius: 18px;
    padding: 20px;
    color: #cbd5e1;
    line-height: 1.7;
}

.modal-note p {
    margin: 0 0 10px;
}

.modal-note p:last-child {
    margin-bottom: 0;
}

@media (max-width: 760px) {
    .concept-row {
        align-items: flex-start;
    }

    .formula-grid {
        grid-template-columns: 1fr;
    }

    .concept-modal-header {
        align-items: flex-start;
    }
}
.mt-card {
    margin-top: 28px;
}

.total-row td {
    background: rgba(34, 211, 238, 0.08);
    color: #67e8f9;
}

.chart-box {
    background: #111827;
    border: 1px solid #263244;
    border-radius: 18px;
    padding: 20px;
    margin-bottom: 22px;
}

.slider-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 18px;
    margin-bottom: 22px;
}

.slider-box {
    background: #111827;
    border: 1px solid #263244;
    border-radius: 18px;
    padding: 18px;
}

.slider-box label {
    display: block;
    color: #cbd5e1;
    font-weight: bold;
    margin-bottom: 12px;
}

.slider-box input[type="range"] {
    width: 100%;
}

.equation-box {
    background: rgba(250, 204, 21, 0.1);
    border: 1px solid rgba(250, 204, 21, 0.35);
    border-radius: 18px;
    padding: 20px;
    margin-bottom: 22px;
    text-align: center;
}

.equation-box span {
    color: #fde68a;
    font-weight: bold;
    font-size: 13px;
    letter-spacing: 1px;
}

.equation-box h2 {
    color: #facc15;
    margin: 10px 0 0;
    font-size: 30px;
}

.ols-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 18px;
}

.form-group input {
    width: 100%;
    background: #111827;
    color: white;
    border: 1px solid #334155;
    border-radius: 14px;
    padding: 14px;
    outline: none;
    font-size: 15px;
}

.form-group input:focus {
    border-color: #22d3ee;
    box-shadow: 0 0 0 3px rgba(34, 211, 238, 0.15);
}

.ols-result-box {
    margin-top: 24px;
    background: rgba(34, 197, 94, 0.1);
    border: 1px solid rgba(34, 197, 94, 0.35);
    border-radius: 18px;
    padding: 22px;
    text-align: center;
}

.ols-result-box span {
    color: #86efac;
    font-weight: bold;
    font-size: 13px;
    letter-spacing: 1px;
}

.ols-result-box h2 {
    color: #bbf7d0;
    font-size: 30px;
    margin: 12px 0;
}

.ols-result-box p {
    color: #dcfce7;
    line-height: 1.6;
    margin: 0;
}

@media (max-width: 760px) {
    .slider-grid,
    .ols-grid {
        grid-template-columns: 1fr;
    }
}
.quiz-question {
    display: flex;
    gap: 18px;
    padding: 22px;
    background: #111827;
    border: 1px solid #263244;
    border-radius: 18px;
    margin-bottom: 18px;
}

.quiz-number {
    width: 40px;
    height: 40px;
    border-radius: 12px;
    background: #22d3ee;
    color: #020617;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    flex-shrink: 0;
}

.quiz-content {
    width: 100%;
}

.quiz-content h3 {
    margin: 0 0 14px;
    color: #e5e7eb;
    line-height: 1.5;
}

.option-list {
    display: grid;
    gap: 10px;
}

.option-item {
    display: flex;
    align-items: center;
    gap: 12px;
    background: rgba(30, 41, 59, 0.65);
    border: 1px solid #334155;
    border-radius: 14px;
    padding: 13px 14px;
    cursor: pointer;
    color: #cbd5e1;
    transition: 0.2s ease;
}

.option-item:hover {
    border-color: #22d3ee;
    background: rgba(8, 47, 73, 0.35);
}

.option-item input {
    accent-color: #22d3ee;
}

.result-summary-card {
    text-align: center;
}

.score-circle {
    width: 140px;
    height: 140px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(250, 204, 21, 0.25), rgba(250, 204, 21, 0.08));
    border: 2px solid rgba(250, 204, 21, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 18px;
    font-size: 48px;
    font-weight: bold;
    color: #facc15;
}

.result-summary-card h2 {
    color: #e5e7eb;
    margin: 0 0 8px;
}

.result-summary-card p {
    color: #94a3b8;
}

.grade-badge {
    display: inline-block;
    padding: 9px 16px;
    border-radius: 999px;
    font-weight: bold;
    margin-top: 10px;
}

.grade-badge.excellent {
    background: rgba(34, 197, 94, 0.15);
    border: 1px solid rgba(34, 197, 94, 0.45);
    color: #86efac;
}

.grade-badge.good {
    background: rgba(250, 204, 21, 0.15);
    border: 1px solid rgba(250, 204, 21, 0.45);
    color: #fde68a;
}

.grade-badge.low {
    background: rgba(239, 68, 68, 0.15);
    border: 1px solid rgba(239, 68, 68, 0.45);
    color: #fca5a5;
}

.result-question-card {
    background: #111827;
    border: 1px solid #263244;
    border-radius: 18px;
    padding: 22px;
    margin-bottom: 18px;
}

.result-question-header {
    display: flex;
    justify-content: space-between;
    gap: 14px;
    align-items: flex-start;
    margin-bottom: 16px;
}

.result-question-header h3 {
    margin: 0;
    color: #e5e7eb;
    line-height: 1.5;
}

.status-correct,
.status-wrong {
    white-space: nowrap;
    padding: 7px 12px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: bold;
}

.status-correct {
    background: rgba(34, 197, 94, 0.15);
    border: 1px solid rgba(34, 197, 94, 0.45);
    color: #86efac;
}

.status-wrong {
    background: rgba(239, 68, 68, 0.15);
    border: 1px solid rgba(239, 68, 68, 0.45);
    color: #fca5a5;
}

.result-option-list {
    display: grid;
    gap: 10px;
}

.result-option {
    display: flex;
    justify-content: space-between;
    gap: 12px;
    align-items: center;
    background: rgba(30, 41, 59, 0.65);
    border: 1px solid #334155;
    border-radius: 14px;
    padding: 13px 14px;
    color: #cbd5e1;
}

.correct-option {
    background: rgba(34, 197, 94, 0.12);
    border-color: rgba(34, 197, 94, 0.55);
    color: #bbf7d0;
}

.wrong-option {
    background: rgba(239, 68, 68, 0.12);
    border-color: rgba(239, 68, 68, 0.55);
    color: #fecaca;
}

.option-note {
    font-size: 12px;
    font-weight: bold;
    color: #94a3b8;
    white-space: nowrap;
}

.answer-info {
    margin-top: 14px;
    background: rgba(15, 23, 42, 0.75);
    border: 1px solid #263244;
    border-radius: 14px;
    padding: 14px;
    color: #cbd5e1;
}

.answer-info p {
    margin: 4px 0;
}

@media (max-width: 760px) {
    .quiz-question {
        flex-direction: column;
    }

    .result-question-header {
        flex-direction: column;
    }

    .result-option {
        flex-direction: column;
        align-items: flex-start;
    }
}
.finish-hero {
    text-align: center;
}

.finish-hero h1 {
    font-size: 40px;
}

.achievement-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 14px;
}

.achievement-item {
    background: #111827;
    border: 1px solid #263244;
    border-radius: 16px;
    padding: 16px;
    color: #cbd5e1;
    line-height: 1.6;
}

.final-result-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 18px;
}

.final-result-card {
    background: linear-gradient(135deg, rgba(8, 47, 73, 0.55), #111827);
    border: 1px solid #263244;
    border-radius: 20px;
    padding: 24px;
    text-align: center;
}

.final-result-card span {
    color: #67e8f9;
    font-weight: bold;
    font-size: 13px;
    letter-spacing: 1px;
}

.final-result-card h2 {
    color: #facc15;
    font-size: 30px;
    margin: 14px 0 8px;
}

.final-result-card p {
    color: #cbd5e1;
    margin: 0;
    line-height: 1.6;
}

.final-message-card {
    text-align: center;
    background: linear-gradient(135deg, rgba(20, 184, 166, 0.14), rgba(15, 23, 42, 0.95));
}

.final-message-card h2 {
    color: #5eead4;
    margin-top: 0;
}

.final-message-card p {
    color: #cbd5e1;
    line-height: 1.7;
}

.next-meeting-box {
    margin-top: 20px;
    background: rgba(250, 204, 21, 0.1);
    border: 1px solid rgba(250, 204, 21, 0.35);
    color: #fde68a;
    padding: 16px;
    border-radius: 16px;
}

@media (max-width: 760px) {
    .achievement-grid,
    .final-result-grid {
        grid-template-columns: 1fr;
    }

    .finish-hero h1 {
        font-size: 32px;
    }
}

@media (max-width: 860px) {
    .topbar {
        flex-wrap: wrap;
        justify-content: space-between;
        padding: 12px 16px;
        min-height: unset;
    }

    .user-area {
        width: 100%;
        justify-content: flex-start;
        flex-wrap: wrap;
        gap: 10px;
    }

    .stepbar {
        padding: 12px 16px;
        gap: 8px;
    }

    .step-item {
        font-size: 12px;
        padding: 8px 10px;
    }

    .hero-card {
        padding: 24px;
    }

    .content-card {
        padding: 18px;
    }

    .objective-item,
    .question-block,
    .quiz-question,
    .concept-row,
    .result-question-header,
    .result-option {
        gap: 12px;
    }
}

@media (max-width: 700px) {
    .topbar,
    .stepbar {
        padding-left: 12px;
        padding-right: 12px;
    }

    .brand {
        font-size: 18px;
    }

    .timer,
    .group-name,
    .username,
    .logout-btn {
        font-size: 13px;
    }

    .step-item {
        font-size: 11px;
        padding: 7px 10px;
    }

    .hero-card {
        padding: 20px;
    }

    .objective-item,
    .question-block,
    .quiz-question,
    .concept-row {
        flex-direction: column;
        align-items: stretch;
    }

    .presentation-header,
    .group-header,
    .like-row,
    .result-question-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .status-correct,
    .status-wrong,
    .plus-btn {
        width: 100%;
        justify-content: center;
    }

    .modal-box,
    .concept-modal-box {
        width: 100%;
        margin: 0 10px;
    }
}
    </style>
</head>
<body>

    @include('partials.navbar')

    @yield('content')

</body>
</html>
