{{--
    Student Stories Section

    Expected controller variable: $stories
    Recommended fields:
    - student_name
    - program
    - story
    - support_type
    - image or image_url
    - is_featured (optional)
--}}

<style>
    .stories-section {
        --stories-primary: #0065a8;
        --stories-primary-dark: #003f6b;
        --stories-primary-light: #eaf5fc;
        --stories-accent: #f5a623;
        --stories-text: #17212b;
        --stories-muted: #667481;
        --stories-border: #dce5ec;
        --stories-white: #ffffff;
        position: relative;
        padding: 100px 0;
        overflow: hidden;
        background:
            radial-gradient(circle at 8% 12%, rgba(0, 101, 168, 0.08), transparent 25%),
            radial-gradient(circle at 92% 88%, rgba(245, 166, 35, 0.10), transparent 24%),
            #f7fafc;
    }

    .stories-section::before {
        position: absolute;
        top: -130px;
        right: -120px;
        width: 330px;
        height: 330px;
        border: 55px solid rgba(0, 101, 168, 0.04);
        border-radius: 50%;
        content: "";
        pointer-events: none;
    }

    .stories-container {
        position: relative;
        z-index: 1;
        width: min(1180px, calc(100% - 40px));
        margin: 0 auto;
    }

    .stories-heading {
        display: grid;
        grid-template-columns: minmax(0, 1fr) minmax(300px, 460px);
        gap: 55px;
        align-items: end;
        margin-bottom: 45px;
    }

    .stories-eyebrow {
        display: inline-flex;
        gap: 9px;
        align-items: center;
        width: fit-content;
        margin-bottom: 15px;
        padding: 8px 14px;
        border: 1px solid rgba(0, 101, 168, 0.16);
        border-radius: 50rem;
        color: var(--stories-primary-dark);
        background: var(--stories-primary-light);
        font-size: 0.82rem;
        font-weight: 750;
        letter-spacing: 0.7px;
        text-transform: uppercase;
    }

    .stories-eyebrow i {
        color: var(--stories-accent);
    }

    .stories-title {
        max-width: 690px;
        margin: 0;
        color: var(--stories-text);
        font-size: clamp(2rem, 4vw, 3.4rem);
        font-weight: 780;
        line-height: 1.12;
        letter-spacing: -1.4px;
    }

    .stories-title span {
        color: var(--stories-primary);
    }

    .stories-introduction {
        margin: 0;
        color: var(--stories-muted);
        font-size: 1rem;
        line-height: 1.8;
    }

    .stories-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 22px;
    }

    .story-card {
        position: relative;
        display: flex;
        min-height: 370px;
        flex-direction: column;
        padding: 28px;
        overflow: hidden;
        border: 1px solid var(--stories-border);
        border-radius: 22px;
        background: rgba(255, 255, 255, 0.96);
        box-shadow: 0 14px 40px rgba(23, 33, 43, 0.07);
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    }

    .story-card::before {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--stories-primary), var(--stories-accent));
        content: "";
    }

    .story-card:hover {
        border-color: rgba(0, 101, 168, 0.25);
        box-shadow: 0 22px 55px rgba(0, 63, 107, 0.13);
        transform: translateY(-7px);
    }

    .story-card-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 24px;
    }

    .story-category {
        display: inline-flex;
        gap: 7px;
        align-items: center;
        max-width: 75%;
        padding: 7px 11px;
        overflow: hidden;
        border-radius: 50rem;
        color: var(--stories-primary-dark);
        background: var(--stories-primary-light);
        font-size: 0.76rem;
        font-weight: 700;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .story-quote-icon {
        display: grid;
        flex: 0 0 42px;
        width: 42px;
        height: 42px;
        place-items: center;
        border-radius: 13px;
        color: var(--stories-primary-dark);
        background: rgba(245, 166, 35, 0.20);
        font-size: 1rem;
    }

    .story-text {
        display: -webkit-box;
        margin: 0 0 28px;
        overflow: hidden;
        color: #34434f;
        font-size: 0.96rem;
        font-style: italic;
        line-height: 1.8;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 6;
    }

    .story-student {
        display: flex;
        gap: 13px;
        align-items: center;
        margin-top: auto;
        padding-top: 20px;
        border-top: 1px solid #edf1f4;
    }

    .story-avatar,
    .story-avatar-fallback {
        flex: 0 0 52px;
        width: 52px;
        height: 52px;
        border: 3px solid var(--stories-white);
        border-radius: 50%;
        box-shadow: 0 4px 14px rgba(23, 33, 43, 0.14);
    }

    .story-avatar {
        object-fit: cover;
    }

    .story-avatar-fallback {
        display: grid;
        place-items: center;
        color: var(--stories-white);
        background: linear-gradient(135deg, var(--stories-primary), var(--stories-primary-dark));
        font-size: 1rem;
        font-weight: 800;
    }

    .story-student-details {
        min-width: 0;
    }

    .story-student-name {
        display: block;
        margin-bottom: 3px;
        overflow: hidden;
        color: var(--stories-text);
        font-size: 0.94rem;
        font-weight: 750;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .story-student-program {
        display: block;
        overflow: hidden;
        color: var(--stories-muted);
        font-size: 0.78rem;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .stories-empty {
        grid-column: 1 / -1;
        padding: 60px 25px;
        border: 1px dashed #b8cad7;
        border-radius: 22px;
        background: rgba(255, 255, 255, 0.72);
        text-align: center;
    }

    .stories-empty-icon {
        display: grid;
        width: 64px;
        height: 64px;
        margin: 0 auto 18px;
        place-items: center;
        border-radius: 18px;
        color: var(--stories-primary);
        background: var(--stories-primary-light);
        font-size: 1.35rem;
    }

    .stories-empty h3 {
        margin: 0 0 8px;
        color: var(--stories-text);
        font-size: 1.2rem;
    }

    .stories-empty p {
        margin: 0;
        color: var(--stories-muted);
    }

    @media (max-width: 991.98px) {
        .stories-section {
            padding: 80px 0;
        }

        .stories-heading {
            grid-template-columns: 1fr;
            gap: 18px;
        }

        .stories-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 767.98px) {
        .stories-section {
            padding: 65px 0;
        }

        .stories-container {
            width: min(100% - 30px, 560px);
        }

        .stories-heading {
            margin-bottom: 30px;
            text-align: center;
        }

        .stories-eyebrow {
            margin-right: auto;
            margin-left: auto;
        }

        .stories-title {
            letter-spacing: -0.7px;
        }

        .stories-grid {
            grid-template-columns: 1fr;
        }

        .story-card {
            min-height: 340px;
            padding: 24px;
        }
    }
</style>

<section class="stories-section" id="testimonials" aria-labelledby="stories-title">
    <div class="stories-container">

        <div class="stories-heading">
            <div>
                <div class="stories-eyebrow">
                    <i class="fa fa-heart"></i>
                    Student Stories
                </div>

                <h2 class="stories-title" id="stories-title">
                    Real support. <span>Meaningful change.</span>
                </h2>
            </div>

            <p class="stories-introduction">
                Discover how the NUST Sharing Network helps students overcome
                challenges, continue their education, and move forward with
                confidence through the generosity of our community.
            </p>
        </div>

        <div class="stories-grid">
            @forelse (($stories ?? collect()) as $story)
                @php
                    $studentName = data_get($story, 'student_name', 'NUST Student');
                    $studentProgram = data_get($story, 'program', 'NUST');
                    $supportType = data_get($story, 'support_type', 'Community Support');
                    $storyText = data_get($story, 'story', '');
                    $storedImage = data_get($story, 'image');
                    $storyImage = data_get($story, 'image_url')
                        ?: ($storedImage ? asset('storage/' . ltrim($storedImage, '/')) : null);
                    $studentInitials = collect(preg_split('/\s+/', trim($studentName)))
                        ->filter()
                        ->take(2)
                        ->map(fn ($namePart) => strtoupper(mb_substr($namePart, 0, 1)))
                        ->implode('');
                @endphp

                <article class="story-card">
                    <div class="story-card-top">
                        <span class="story-category">
                            <i class="fa fa-gift"></i>
                            {{ $supportType }}
                        </span>

                        <span class="story-quote-icon" aria-hidden="true">
                            <i class="fa fa-quote-left"></i>
                        </span>
                    </div>

                    <blockquote class="story-text">
                        &ldquo;{{ $storyText }}&rdquo;
                    </blockquote>

                    <div class="story-student">
                        @if ($storyImage)
                            <img
                                class="story-avatar"
                                src="{{ $storyImage }}"
                                alt="{{ $studentName }}"
                                loading="lazy"
                            >
                        @else
                            <span class="story-avatar-fallback" aria-hidden="true">
                                {{ $studentInitials ?: 'NS' }}
                            </span>
                        @endif

                        <div class="story-student-details">
                            <strong class="story-student-name">
                                {{ $studentName }}
                            </strong>

                            <span class="story-student-program">
                                {{ $studentProgram }}
                            </span>
                        </div>
                    </div>
                </article>
            @empty
                <div class="stories-empty">
                    <span class="stories-empty-icon">
                        <i class="fa fa-book"></i>
                    </span>

                    <h3>Student stories are coming soon</h3>

                    <p>
                        Approved student experiences will appear here.
                    </p>
                </div>
            @endforelse
        </div>

    </div>
</section>
