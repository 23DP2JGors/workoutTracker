<template>
  <transition name="page-fade">
    <div v-if="showPage">
      <div class="hero" ref="heroRef">
        <v-container class="hero-container">
            <div class="hero-content">
                <div class="hero-title font-weight-black">
                    <div data-hero-line>{{ $t('landing.heroLine1') }}</div>
                    <div data-hero-line>{{ $t('landing.heroLine2') }}</div>
                    <div data-hero-line>{{ $t('landing.heroLine3') }}</div>
                </div>

                <div class="hero-actions">
                    <router-link to="/register" class="text-decoration-none">
                        <v-btn
                            ref="heroCtaRef"
                            class="hero-cta"
                            color="primary"
                            size="large"
                            rounded="lg"
                            elevation="0"
                        >
                            {{ $t('landing.startFree') }}
                        </v-btn>
                    </router-link>
                </div>
            </div>

            <div ref="mascotRef" class="mascot-stage" aria-hidden="true">
                <img
                    ref="mascotImageRef"
                    class="mascot-image"
                    src="/images/mascot/mascot_Peng.png"
                    alt=""
                    draggable="false"
                />
            </div>
        </v-container>
      </div>

      <!-- Core Features showcase -->
      <section ref="coreFeaturesRef" class="core-features">
        <v-container class="core-showcase">
          <div class="core-copy">
            <div class="core-heading">
              <p class="core-eyebrow text-label-medium">{{ $t('landing.coreFeatures') }}</p>
              <h2 class="text-headline-small font-weight-bold">
                {{ $t('landing.coreFeaturesSubtitle') }}
              </h2>
            </div>

            <div class="core-progress" aria-hidden="true">
              <span class="core-progress-fill"></span>
            </div>

            <div class="core-steps">
              <article class="core-step is-active" data-core-step="0">
                <span class="core-step-number">01</span>
                <div>
                  <h3 class="text-title-medium font-weight-bold">
                    {{ $t('landing.features.workoutLogging.title') }}
                  </h3>
                  <p class="text-body-medium text-medium-emphasis">
                    {{ $t('landing.features.workoutLogging.text') }}
                  </p>
                </div>
              </article>

              <article class="core-step" data-core-step="1">
                <span class="core-step-number">02</span>
                <div>
                  <h3 class="text-title-medium font-weight-bold">
                    {{ $t('landing.features.bodyMeasurements.title') }}
                  </h3>
                  <p class="text-body-medium text-medium-emphasis">
                    {{ $t('landing.features.bodyMeasurements.text') }}
                  </p>
                </div>
              </article>

              <article class="core-step" data-core-step="2">
                <span class="core-step-number">03</span>
                <div>
                  <h3 class="text-title-medium font-weight-bold">
                    {{ $t('landing.features.macroCalculator.title') }}
                  </h3>
                  <p class="text-body-medium text-medium-emphasis">
                    {{ $t('landing.features.macroCalculator.text') }}
                  </p>
                </div>
              </article>
            </div>
          </div>

          <div class="core-visuals" aria-live="polite">
            <div class="core-visual is-active" data-core-visual="0">
              <div class="visual-glow"></div>
              <img
                class="workout-mascot"
                src="/images/mascot/workout_log.png"
                alt=""
                draggable="false"
              />
            </div>

            <div class="core-visual measurement-stage" data-core-visual="1">
              <div class="visual-glow"></div>
              <v-card class="measurement-preview" variant="flat" rounded="xl">
                <div class="preview-topline">
                  <v-icon icon="mdi-scale-bathroom" size="36" color="primary" />
                  <span class="preview-label text-body-small">Weight</span>
                </div>
                <div class="measurement-value text-display-small font-weight-bold">78.4 <small>kg</small></div>
                <div class="mini-chart" aria-hidden="true">
                  <span style="height: 38%"></span>
                  <span style="height: 52%"></span>
                  <span style="height: 46%"></span>
                  <span style="height: 68%"></span>
                  <span style="height: 61%"></span>
                  <span style="height: 78%"></span>
                </div>
              </v-card>
            </div>

            <div class="core-visual macro-stage" data-core-visual="2">
              <div class="visual-glow"></div>
              <v-card class="macro-preview" variant="flat" rounded="xl">
                <v-icon icon="mdi-calculator" size="42" color="primary" />
                <div class="macro-ring">
                  <div class="macro-ring-center">
                    <strong>2,180</strong>
                    <span>kcal</span>
                  </div>
                </div>
                <div class="macro-bars">
                  <div><span>Protein</span><i class="protein-bar"></i></div>
                  <div><span>Carbs</span><i class="carbs-bar"></i></div>
                  <div><span>Fats</span><i class="fats-bar"></i></div>
                </div>
              </v-card>
            </div>
          </div>
        </v-container>
      </section>

      <!-- Extra Features kinetic section -->
      <section ref="extraFeaturesRef" class="extra-features">
        <div ref="kineticTextRef" class="kinetic-text" aria-hidden="true">
          STRENGTH · PATTERNS · CUSTOM · CHARTS · COACHING
        </div>

        <div class="extra-heading">
          <p class="extra-eyebrow text-label-medium">{{ $t('landing.extraFeatures.eyebrow') }}</p>
          <h2 class="text-headline-small font-weight-bold">
            {{ $t('landing.extraFeatures.title') }}
          </h2>
        </div>

        <svg class="extra-connect-path" viewBox="0 0 1800 300" fill="none" aria-hidden="true">
          <path class="draw-path" d="M20 210 C220 80 330 260 520 145 C720 25 840 245 1030 125 C1230 5 1360 230 1780 95" />
        </svg>

        <div ref="extraTrackRef" class="extra-track">
          <article class="extra-station" data-extra-station="0">
            <span class="extra-number">01</span>
            <div class="extra-copy">
              <h3>{{ $t('landing.extraFeatures.oneRm.title') }}</h3>
              <p>{{ $t('landing.extraFeatures.oneRm.text') }}</p>
              <span class="extra-tag">{{ $t('landing.extraFeatures.oneRm.tag') }}</span>
            </div>
            <svg class="extra-drawing" viewBox="0 0 300 220" fill="none" aria-hidden="true">
              <path class="draw-path" d="M25 190 A125 125 0 0 1 275 190" />
              <path class="draw-path indigo" d="M150 190 L150 78" />
              <circle class="draw-dot" cx="150" cy="78" r="12" />
              <path class="draw-path gold" d="M118 54 H182 M150 54 V36 M130 36 H170" />
            </svg>
          </article>

          <article class="extra-station" data-extra-station="1">
            <span class="extra-number">02</span>
            <div class="extra-copy">
              <h3>{{ $t('landing.extraFeatures.templates.title') }}</h3>
              <p>{{ $t('landing.extraFeatures.templates.text') }}</p>
              <span class="extra-tag">{{ $t('landing.extraFeatures.templates.tag') }}</span>
            </div>
            <svg class="extra-drawing" viewBox="0 0 300 220" fill="none" aria-hidden="true">
              <path class="draw-path" d="M35 180 V55 M35 180 H270" />
              <path class="draw-bar gold" d="M65 145 V180 M105 115 V180 M145 130 V180 M185 75 V180 M225 95 V180" />
              <path class="draw-path indigo" d="M65 145 L105 115 L145 130 L185 75 L225 95" />
            </svg>
          </article>

          <article class="extra-station" data-extra-station="2">
            <span class="extra-number">03</span>
            <div class="extra-copy">
              <h3>{{ $t('landing.extraFeatures.exercises.title') }}</h3>
              <p>{{ $t('landing.extraFeatures.exercises.text') }}</p>
              <span class="extra-tag">{{ $t('landing.extraFeatures.exercises.tag') }}</span>
            </div>
            <svg class="extra-drawing" viewBox="0 0 300 220" fill="none" aria-hidden="true">
              <path class="draw-path gold" d="M55 110 H245 M75 82 V138 M225 82 V138 M55 110 L35 110 M245 110 H265" />
              <circle class="draw-dot indigo" cx="150" cy="110" r="42" />
              <path class="draw-path indigo" d="M150 68 V152 M108 110 H192" />
            </svg>
          </article>

          <article class="extra-station" data-extra-station="3">
            <span class="extra-number">04</span>
            <div class="extra-copy">
              <h3>{{ $t('landing.extraFeatures.charts.title') }}</h3>
              <p>{{ $t('landing.extraFeatures.charts.text') }}</p>
              <span class="extra-tag">{{ $t('landing.extraFeatures.charts.tag') }}</span>
            </div>
            <svg class="extra-drawing" viewBox="0 0 300 220" fill="none" aria-hidden="true">
              <path class="draw-path" d="M30 185 H270 M40 170 V35" />
              <path class="draw-path gold" d="M42 160 C75 145 92 158 120 125 C148 92 170 112 198 78 C220 52 244 58 266 38" />
              <circle class="draw-dot indigo" cx="266" cy="38" r="9" />
            </svg>
          </article>

          <article class="extra-station" data-extra-station="4">
            <span class="extra-number">05</span>
            <div class="extra-copy">
              <h3>{{ $t('landing.extraFeatures.trainer.title') }}</h3>
              <p>{{ $t('landing.extraFeatures.trainer.text') }}</p>
              <span class="extra-tag">{{ $t('landing.extraFeatures.trainer.tag') }}</span>
            </div>
            <svg class="extra-drawing" viewBox="0 0 300 220" fill="none" aria-hidden="true">
              <circle class="draw-path gold" cx="150" cy="110" r="72" />
              <path class="draw-path indigo" d="M78 110 H115 L132 72 L158 150 L178 110 H222" />
              <circle class="draw-dot gold" cx="150" cy="110" r="7" />
            </svg>
          </article>
        </div>
      </section>

      <!-- Final personal-records showcase -->
      <section ref="finalSectionRef" class="final-progress-section">
        <div class="final-progress-glow" aria-hidden="true"></div>

        <v-container class="final-progress-container">
          <div class="final-copy">
            <p class="final-eyebrow text-label-medium" data-final-reveal>
              {{ $t('landing.finalSection.eyebrow') }}
            </p>
            <h2 class="final-title text-headline-large font-weight-black" data-final-reveal>
              {{ $t('landing.finalSection.title') }}
            </h2>
            <p class="final-description text-body-medium" data-final-reveal>
              {{ $t('landing.finalSection.description') }}
            </p>

            <div class="record-highlights" data-final-reveal>
              <div class="record-highlight">
                <strong>PR</strong>
                <span>{{ $t('landing.finalSection.prs') }}</span>
              </div>
              <div class="record-highlight">
                <strong>+%</strong>
                <span>{{ $t('landing.finalSection.progress') }}</span>
              </div>
              <div class="record-highlight">
                <strong>7d</strong>
                <span>{{ $t('landing.finalSection.consistency') }}</span>
              </div>
            </div>

            <router-link to="/register" class="text-decoration-none">
              <v-btn
                class="final-cta"
                color="primary"
                size="large"
                rounded="lg"
                elevation="0"
                data-final-reveal
              >
                {{ $t('landing.finalSection.cta') }}
              </v-btn>
            </router-link>
          </div>

          <div class="record-visual" data-final-reveal aria-label="Personal progress preview">
            <div class="record-visual-top">
              <span>{{ $t('landing.finalSection.latestPr') }}</span>
              <span class="record-status">NEW PR</span>
            </div>
            <div class="record-score">
              <strong>120</strong>
              <span>kg</span>
            </div>
            <svg class="record-line" viewBox="0 0 480 180" fill="none" aria-hidden="true">
              <path class="record-grid" d="M20 150H460 M20 105H460 M20 60H460" />
              <path class="record-progress-line" d="M25 138 C90 132 122 118 168 120 C220 122 250 92 302 96 C350 100 392 58 455 38" />
              <circle class="record-point" cx="455" cy="38" r="9" />
            </svg>
          </div>
        </v-container>
      </section>
    </div>
  </transition>
</template>

<script setup>
import { ref, onMounted, onUnmounted, nextTick } from 'vue'
import { ScrollTrigger } from 'gsap/ScrollTrigger'
import gsap from 'gsap'

gsap.registerPlugin(ScrollTrigger)

const showPage = ref(false)
const heroRef = ref(null)
const heroCtaRef = ref(null)
const mascotRef = ref(null)
const mascotImageRef = ref(null)
const coreFeaturesRef = ref(null)
const extraFeaturesRef = ref(null)
const extraTrackRef = ref(null)
const kineticTextRef = ref(null)
const finalSectionRef = ref(null)

let gsapContext = null
let floatTween = null
let removeCursorTracking = null
const timers = []

onMounted(async () => {
    timers.push(setTimeout(async () => {
        showPage.value = true
        await nextTick()

        gsapContext = gsap.context(() => {
            const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches

            if (reducedMotion) {
                gsap.set(['[data-hero-line]', '.hero-cta', '.mascot-stage'], {
                    opacity: 1,
                    y: 0,
                    x: 0,
                    rotate: 0,
                })
            } else {
                const entrance = gsap.timeline({ defaults: { ease: 'power3.out' } })
                entrance
                    .from('[data-hero-line]', { y: 28, opacity: 0, stagger: 0.12, duration: 0.75 })
                    .from('.hero-cta', { y: 18, opacity: 0, duration: 0.55 }, '-=0.35')
                    .from('.mascot-stage', { x: 36, opacity: 0, scale: 0.96, duration: 0.9 }, '-=0.65')

                floatTween = gsap.to(mascotImageRef.value, {
                    y: -8,
                    duration: 2.8,
                    ease: 'sine.inOut',
                    yoyo: true,
                    repeat: -1,
                })

                const canTrackCursor = window.matchMedia('(hover: hover) and (pointer: fine)').matches
                    && window.innerWidth > 900

                if (canTrackCursor) {
                    const moveX = gsap.quickTo(mascotRef.value, 'x', { duration: 0.55, ease: 'power3.out' })
                    const moveY = gsap.quickTo(mascotRef.value, 'y', { duration: 0.55, ease: 'power3.out' })
                    const tilt = gsap.quickTo(mascotRef.value, 'rotation', { duration: 0.55, ease: 'power3.out' })

                    const handlePointerMove = event => {
                        const rect = heroRef.value.getBoundingClientRect()
                        const normalizedX = ((event.clientX - rect.left) / rect.width - 0.5) * 2
                        const normalizedY = ((event.clientY - rect.top) / rect.height - 0.5) * 2
                        moveX(normalizedX * 12)
                        moveY(normalizedY * 8)
                        tilt(normalizedX * 1.8)
                    }

                    const resetMascot = () => {
                        moveX(0)
                        moveY(0)
                        tilt(0)
                    }

                    heroRef.value.addEventListener('pointermove', handlePointerMove)
                    heroRef.value.addEventListener('pointerleave', resetMascot)
                    removeCursorTracking = () => {
                        heroRef.value?.removeEventListener('pointermove', handlePointerMove)
                        heroRef.value?.removeEventListener('pointerleave', resetMascot)
                    }
                }
            }

            const media = gsap.matchMedia()

            media.add('(min-width: 960px) and (prefers-reduced-motion: no-preference)', () => {
                coreFeaturesRef.value.classList.remove('core-features--fallback')
                extraFeaturesRef.value.classList.remove('extra-features--fallback')

                const steps = gsap.utils.toArray('[data-core-step]')
                const visuals = gsap.utils.toArray('[data-core-visual]')
                const progress = '.core-progress-fill'

                gsap.set(visuals.slice(1), { autoAlpha: 0, y: 24, scale: 0.96 })
                gsap.set(visuals[0], { autoAlpha: 1, y: 0, scale: 1 })
                gsap.set(progress, { scaleX: 0 })

                const setActiveStep = index => {
                    steps.forEach((step, stepIndex) => {
                        step.classList.toggle('is-active', stepIndex === index)
                    })
                }

                const timeline = gsap.timeline({
                    scrollTrigger: {
                        trigger: coreFeaturesRef.value,
                        start: 'center center',
                        end: '+=180%',
                        pin: true,
                        pinSpacing: true,
                        scrub: 0.6,
                        invalidateOnRefresh: true,
                        onUpdate: self => {
                            gsap.set(progress, { scaleX: self.progress })
                            setActiveStep(self.progress < 0.34 ? 0 : self.progress < 0.67 ? 1 : 2)
                        },
                    },
                })

                timeline
                    .to(visuals[0], { autoAlpha: 0, y: -18, scale: 0.96, duration: 0.16 }, 0.28)
                    .to(visuals[1], { autoAlpha: 1, y: 0, scale: 1, duration: 0.16 }, 0.28)
                    .to(visuals[1], { autoAlpha: 0, y: -18, scale: 0.96, duration: 0.16 }, 0.62)
                    .to(visuals[2], { autoAlpha: 1, y: 0, scale: 1, duration: 0.16 }, 0.62)

                const travel = () => {
                    const sectionWidth = extraFeaturesRef.value.clientWidth
                    const trackWidth = extraTrackRef.value.scrollWidth
                    return Math.max(0, trackWidth - sectionWidth + 96)
                }

                const extraPaths = gsap.utils.toArray('.extra-features .draw-path')
                extraPaths.forEach(path => {
                    const length = path.getTotalLength()
                    gsap.set(path, { strokeDasharray: length, strokeDashoffset: length })
                })

                gsap.set('.extra-features .draw-dot', { scale: 0.65, transformOrigin: 'center' })

                const kineticStart = () => {
                    const sectionWidth = extraFeaturesRef.value.clientWidth
                    const textWidth = kineticTextRef.value.scrollWidth
                    return Math.min(24, sectionWidth - textWidth - 24)
                }

                const kineticEnd = () => 24

                gsap.set(kineticTextRef.value, { x: kineticStart() })

                const extraTimeline = gsap.timeline({
                    scrollTrigger: {
                        trigger: extraFeaturesRef.value,
                        start: 'top top',
                        end: () => `+=${travel()}`,
                        pin: true,
                        pinSpacing: true,
                        scrub: 0.7,
                        invalidateOnRefresh: true,
                    },
                })

                extraTimeline
                    .to(extraTrackRef.value, { x: () => -travel(), ease: 'none' }, 0)
                    .to(kineticTextRef.value, { x: kineticEnd, ease: 'none' }, 0)
                    .to(extraPaths, { strokeDashoffset: 0, duration: 0.9, stagger: 0.03, ease: 'power1.inOut' }, 0.08)
                    .to('.extra-features .draw-dot', { scale: 1, stagger: 0.04, duration: 0.35 }, 0.25)

                const finalReveal = gsap.utils.toArray('[data-final-reveal]')
                gsap.set(finalReveal, { opacity: 0, y: 30 })

                const recordLine = finalSectionRef.value.querySelector('.record-progress-line')
                const recordPoint = finalSectionRef.value.querySelector('.record-point')
                if (recordLine) {
                    const lineLength = recordLine.getTotalLength()
                    gsap.set(recordLine, { strokeDasharray: lineLength, strokeDashoffset: lineLength })
                }
                if (recordPoint) gsap.set(recordPoint, { scale: 0, transformOrigin: 'center' })

                const finalTimeline = gsap.timeline({
                    scrollTrigger: {
                        trigger: finalSectionRef.value,
                        start: 'top 78%',
                        once: true,
                    },
                })

                finalTimeline
                    .to(finalReveal, { opacity: 1, y: 0, duration: 0.75, stagger: 0.09, ease: 'power3.out' })
                    .to(recordLine, { strokeDashoffset: 0, duration: 1.1, ease: 'power2.out' }, 0.25)
                    .to(recordPoint, { scale: 1, duration: 0.35, ease: 'back.out(2)' }, 0.9)

                return () => {
                    timeline.scrollTrigger?.kill()
                    timeline.kill()
                    extraTimeline.scrollTrigger?.kill()
                    extraTimeline.kill()
                    finalTimeline.scrollTrigger?.kill()
                    finalTimeline.kill()
                }
            })

            media.add('(max-width: 959px), (prefers-reduced-motion: reduce)', () => {
                coreFeaturesRef.value.classList.add('core-features--fallback')
                extraFeaturesRef.value.classList.add('extra-features--fallback')
                gsap.set(extraTrackRef.value, { x: 0, clearProps: 'position' })
                gsap.set(kineticTextRef.value, { x: 0 })
                gsap.set('.extra-features .draw-path', { clearProps: 'strokeDasharray,strokeDashoffset' })
                gsap.set('.extra-features .draw-dot', { scale: 1, clearProps: 'transform' })

                return () => {
                    coreFeaturesRef.value?.classList.remove('core-features--fallback')
                    extraFeaturesRef.value?.classList.remove('extra-features--fallback')
                }
            })
        })
    }, 300))
})

onUnmounted(() => {
    timers.forEach(clearTimeout)
    removeCursorTracking?.()
    floatTween?.kill()
    gsapContext?.revert()
})
</script>

<style scoped>
/* Layered dark Hero gradient that fades into the next section */
.hero {
    position: relative;
    min-height: 100vh;
    overflow: hidden;
    background:
        radial-gradient(circle at 76% 46%, rgba(124, 134, 255, 0.18) 0%, rgba(124, 134, 255, 0.06) 23%, transparent 48%),
        radial-gradient(circle at 18% 18%, rgba(255, 210, 63, 0.055) 0%, transparent 28%),
        linear-gradient(135deg, #11142A 0%, #0B0D17 62%, #0B0D17 100%);
}

.hero::after {
    content: '';
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    height: 180px;
    pointer-events: none;
    background: linear-gradient(to bottom, transparent 0%, rgba(11, 13, 23, 0.88) 72%, #0B0D17 100%);
}

/* Balanced desktop layout */
.hero-container {
    position: relative;
    z-index: 1;
    min-height: 100vh;
    display: grid;
    grid-template-columns: minmax(0, 1fr) minmax(320px, 500px);
    align-items: center;
    gap: clamp(24px, 5vw, 72px);
    padding-top: 96px;
    padding-bottom: 56px;
}

.hero-content {
    min-width: 0;
    text-align: left;
}

/* Responsive hero headline size */
.hero-title {
    max-width: 680px;
    font-size: clamp(2.4rem, 6vw, 4.1rem);
    line-height: 1.08;
    letter-spacing: -0.04em;
}

/* Hero actions margin */
.hero-actions {
    margin-top: 28px;
}

/* Prominent primary Hero CTA */
.hero-cta {
    min-width: 178px;
    min-height: 54px;
    padding-inline: 34px;
    font-size: 1.125rem;
    font-weight: 800;
    box-shadow: 0 14px 34px rgba(124, 134, 255, 0.28);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.hero-cta:hover {
    transform: translateY(-3px);
    box-shadow: 0 18px 42px rgba(124, 134, 255, 0.38);
}

/* Mascot stage and ambient glow */
.mascot-stage {
    position: relative;
    width: 100%;
    max-width: 500px;
    justify-self: end;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: visible;
}

.mascot-stage::before {
    content: '';
    position: absolute;
    width: 88%;
    aspect-ratio: 1;
    border-radius: 50%;
    background:
        radial-gradient(circle at 58% 48%, rgba(124, 134, 255, 0.24) 0%, rgba(124, 134, 255, 0.11) 38%, transparent 68%),
        radial-gradient(circle at 38% 72%, rgba(255, 210, 63, 0.10) 0%, transparent 42%);
    filter: blur(14px);
    z-index: 0;
}

.mascot-image {
    position: relative;
    z-index: 1;
    display: block;
    width: 100%;
    max-height: min(72vh, 680px);
    object-fit: contain;
    object-position: center;
    user-select: none;
    filter: drop-shadow(0 26px 34px rgba(0, 0, 0, 0.34));
}

/* Core Features section styles */
.core-features {
    position: relative;
    min-height: 100svh;
    overflow: hidden;
    background: #0B0D17;
}

.core-showcase {
    height: 100svh;
    min-height: 680px;
    box-sizing: border-box;
    display: grid;
    grid-template-columns: minmax(320px, 0.88fr) minmax(420px, 1.12fr);
    align-items: center;
    gap: clamp(32px, 5vw, 80px);
    padding-top: 84px;
    padding-bottom: 38px;
}

.core-copy,
.core-visuals {
    min-width: 0;
}

.core-heading {
    max-width: 560px;
}

.core-heading h2 {
    max-width: 520px;
    line-height: 1.18;
}

.core-eyebrow {
    margin: 0 0 12px;
    color: #7C86FF;
    font-weight: 800;
    letter-spacing: 0.12em;
    text-transform: uppercase;
}

.core-progress {
    width: 100%;
    height: 3px;
    margin: 22px 0 16px;
    overflow: hidden;
    border-radius: 999px;
    background: rgba(233, 235, 250, 0.10);
}

.core-progress-fill {
    display: block;
    width: 100%;
    height: 100%;
    transform-origin: left center;
    background: linear-gradient(90deg, #7C86FF, #FFD23F);
}

.core-steps {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.core-step {
    position: relative;
    display: grid;
    grid-template-columns: 48px 1fr;
    gap: 10px;
    padding: 15px 16px;
    border: 1px solid rgba(233, 235, 250, 0.055);
    border-radius: 16px;
    opacity: 0.42;
    color: #8E94B8;
    background: rgba(20, 24, 41, 0.28);
    transition: opacity 0.35s ease, border-color 0.35s ease, background 0.35s ease, transform 0.35s ease;
}

.core-step.is-active {
    opacity: 1;
    transform: translateX(6px);
    border-color: rgba(124, 134, 255, 0.72);
    background: linear-gradient(90deg, rgba(124, 134, 255, 0.16), rgba(20, 24, 41, 0.82));
    box-shadow: inset 3px 0 0 #FFD23F, 0 12px 36px rgba(4, 6, 18, 0.28);
}

.core-step-number {
    color: #7C86FF;
    font-size: 0.82rem;
    font-weight: 900;
    letter-spacing: 0.12em;
}

.core-step.is-active .core-step-number {
    color: #FFD23F;
}

.core-step h3,
.core-step p {
    margin: 0;
}

.core-step h3 {
    color: #E9EBFA;
    font-size: 1.12rem;
    line-height: 1.25;
}

.core-step p {
    margin-top: 5px;
    max-width: 520px;
    color: #A7ABD0;
    line-height: 1.45;
}

.core-visuals {
    position: relative;
    min-height: min(560px, 70vh);
    height: min(560px, 70vh);
}

.core-visual {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    visibility: hidden;
}

.core-visual.is-active {
    opacity: 1;
    visibility: visible;
}

.visual-glow {
    position: absolute;
    width: 78%;
    aspect-ratio: 1;
    border-radius: 50%;
    background:
        radial-gradient(circle, rgba(124, 134, 255, 0.24) 0%, rgba(124, 134, 255, 0.08) 42%, transparent 68%),
        radial-gradient(circle at 68% 68%, rgba(255, 210, 63, 0.10), transparent 42%);
    filter: blur(12px);
}

.workout-mascot {
    position: relative;
    z-index: 1;
    width: min(100%, 520px);
    max-height: 540px;
    object-fit: contain;
    filter: drop-shadow(0 28px 38px rgba(0, 0, 0, 0.38));
}

.measurement-preview,
.macro-preview {
    position: relative;
    z-index: 1;
    width: min(78%, 430px);
    height: 400px;
    min-height: 400px;
    padding: 28px 30px;
    border: 1px solid rgba(124, 134, 255, 0.22);
    background: rgba(20, 24, 41, 0.92) !important;
    box-shadow: 0 24px 70px rgba(4, 6, 18, 0.55), 0 0 42px rgba(124, 134, 255, 0.08);
}

.preview-topline {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.preview-label {
    color: #8E94B8;
}

.measurement-value {
    margin-top: 28px;
}

.measurement-value small {
    color: #8E94B8;
    font-size: 0.55em;
}

.mini-chart {
    height: 150px;
    display: flex;
    align-items: flex-end;
    gap: 12px;
    margin-top: 22px;
    padding: 18px 10px 0;
    border-bottom: 1px solid rgba(233, 235, 250, 0.10);
}

.mini-chart span {
    flex: 1;
    min-width: 18px;
    border-radius: 8px 8px 2px 2px;
    background: linear-gradient(180deg, #7C86FF, rgba(124, 134, 255, 0.28));
}

.macro-preview {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.macro-ring {
    width: 190px;
    height: 190px;
    display: grid;
    place-items: center;
    margin: 14px 0 18px;
    border-radius: 50%;
    background:
        conic-gradient(#7C86FF 0 56%, #FFD23F 56% 78%, rgba(233, 235, 250, 0.12) 78% 100%);
    box-shadow: 0 0 38px rgba(124, 134, 255, 0.14);
}

.macro-ring::before {
    content: '';
    position: absolute;
    width: 140px;
    height: 140px;
    border-radius: 50%;
    background: #141829;
}

.macro-ring-center {
    position: relative;
    z-index: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.macro-ring-center strong {
    font-size: 1.55rem;
}

.macro-ring-center span {
    color: #8E94B8;
}

.macro-bars {
    width: 100%;
    display: grid;
    gap: 10px;
}

.macro-bars div {
    display: grid;
    grid-template-columns: 64px 1fr;
    align-items: center;
    gap: 10px;
    color: #8E94B8;
    font-size: 0.8rem;
}

.macro-bars i {
    height: 8px;
    border-radius: 999px;
}

.protein-bar { width: 82%; background: #7C86FF; }
.carbs-bar { width: 68%; background: #FFD23F; }
.fats-bar { width: 46%; background: #8E94B8; }

/* Page fade animation settings */
.page-fade-enter-active {
    transition: all 0.6s ease;
    transition-delay: 0.1s;
}

/* Page fade start state */
.page-fade-enter-from {
    opacity: 0;
    transform: translateY(20px);
}

/* Page fade end state */
.page-fade-enter-to {
    opacity: 1;
    transform: translateY(0);
}

/* Keep preview scenes compact within the pinned viewport */
.workout-mascot {
    max-height: min(540px, 66vh);
}

.measurement-preview,
.macro-preview {
    height: 400px;
    min-height: 400px;
    padding: 28px 30px;
}

.mini-chart {
    height: 150px;
    margin-top: 22px;
}

.macro-ring {
    width: 190px;
    height: 190px;
    margin: 14px 0 18px;
}

.macro-ring::before {
    width: 140px;
    height: 140px;
}

/* Mobile and reduced-motion fallback */
.core-features--fallback,
.core-features--fallback .core-showcase {
    height: auto;
    min-height: 0;
}

.core-features--fallback .core-showcase {
    grid-template-columns: 1fr;
    padding-top: 72px;
    padding-bottom: 72px;
}

.core-features--fallback .core-visuals {
    height: auto;
    min-height: 0;
    display: grid;
    gap: 20px;
}

.core-features--fallback .core-visual {
    position: relative;
    inset: auto;
    min-height: 420px;
    opacity: 1 !important;
    visibility: visible !important;
}

/* Cardless kinetic Extra Features showcase */
.extra-features {
    position: relative;
    height: 100svh;
    min-height: 680px;
    overflow: hidden;
    background:
        radial-gradient(circle at 78% 48%, rgba(124, 134, 255, 0.10), transparent 30%),
        #0B0D17;
}

.extra-heading {
    position: absolute;
    top: 112px;
    left: clamp(24px, 6vw, 96px);
    z-index: 4;
    max-width: 620px;
}

.extra-eyebrow {
    margin: 0 0 8px;
    color: #FFD23F;
    font-weight: 900;
    letter-spacing: 0.14em;
    text-transform: uppercase;
}

.extra-heading h2 {
    margin: 0;
}

.kinetic-text {
    position: absolute;
    z-index: 0;
    left: 0;
    bottom: 4vh;
    white-space: nowrap;
    font-size: clamp(6rem, 13vw, 13rem);
    line-height: 0.82;
    font-weight: 900;
    letter-spacing: -0.06em;
    color: rgba(233, 235, 250, 0.035);
    -webkit-text-stroke: 1px rgba(124, 134, 255, 0.10);
    pointer-events: none;
}

.extra-connect-path {
    position: absolute;
    left: 0;
    bottom: 8%;
    z-index: 1;
    width: 1800px;
    height: 300px;
    opacity: 0.22;
    pointer-events: none;
}

.extra-track {
    position: relative;
    z-index: 2;
    height: 100%;
    width: max-content;
    display: flex;
    align-items: center;
    gap: clamp(70px, 7vw, 130px);
    padding: 120px 7vw 30px;
    will-change: transform;
}

.extra-station {
    position: relative;
    flex: 0 0 clamp(520px, 44vw, 660px);
    min-height: 470px;
    display: flex;
    align-items: flex-start;
    gap: clamp(28px, 3vw, 46px);
}

.extra-number {
    flex: 0 0 clamp(110px, 9vw, 150px);
    color: #FFD23F;
    font-size: clamp(4.5rem, 7vw, 7.5rem);
    line-height: 0.78;
    font-weight: 950;
    letter-spacing: -0.08em;
}

.extra-copy {
    min-width: 0;
    max-width: 420px;
    padding-top: 8px;
}

.extra-copy h3 {
    margin: 0 0 12px;
    color: #E9EBFA;
    font-size: clamp(2rem, 3.2vw, 3.35rem);
    line-height: 1;
    letter-spacing: -0.035em;
}

.extra-copy p {
    max-width: 380px;
    margin: 0 0 18px;
    color: #BFC4E6;
    font-size: 1.05rem;
    line-height: 1.55;
}

.extra-tag {
    display: inline-block;
    color: #FFD23F;
    font-size: 0.82rem;
    font-weight: 900;
    letter-spacing: 0.09em;
    text-transform: uppercase;
    border-bottom: 2px solid rgba(255, 210, 63, 0.72);
    padding-bottom: 5px;
}

.extra-drawing {
    position: absolute;
    right: 0;
    bottom: -32px;
    width: min(42%, 280px);
    height: auto;
    overflow: visible;
    filter: drop-shadow(0 12px 24px rgba(124, 134, 255, 0.10));
}

.extra-drawing .draw-path,
.extra-connect-path .draw-path {
    stroke: #7C86FF;
    stroke-width: 5;
    stroke-linecap: round;
    stroke-linejoin: round;
}

.extra-drawing .draw-path.gold,
.extra-drawing .draw-bar.gold {
    stroke: #FFD23F;
}

.extra-drawing .draw-path.indigo,
.extra-drawing .draw-dot.indigo {
    stroke: #7C86FF;
}

.extra-drawing .draw-dot {
    fill: #FFD23F;
    stroke: #FFD23F;
    stroke-width: 3;
}

.extra-drawing .draw-dot.indigo {
    fill: #7C86FF;
}

.extra-drawing .draw-bar {
    stroke-width: 28;
    stroke-linecap: round;
}

.extra-features--fallback {
    height: auto;
    min-height: 0;
    padding: 72px 16px;
}

.extra-features--fallback .extra-heading {
    position: relative;
    top: auto;
    left: auto;
    max-width: 620px;
    margin: 0 auto 36px;
    text-align: center;
}

.extra-features--fallback .kinetic-text {
    display: none;
}

.extra-features--fallback .extra-connect-path {
    display: none;
}

.extra-features--fallback .extra-track {
    width: 100%;
    height: auto;
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 46px 24px;
    padding: 0;
}

.extra-features--fallback .extra-station {
    width: 100%;
    min-width: 0;
    min-height: 390px;
    display: flex;
    align-items: flex-start;
    gap: 18px;
}

.extra-features--fallback .extra-number {
    flex-basis: 48px;
    font-size: 3.35rem;
}

@media (max-width: 959px) {
    .extra-features--fallback {
        overflow: hidden;
        padding: 64px 16px;
    }

    .extra-features--fallback .extra-track {
        grid-template-columns: 1fr;
        gap: 28px;
        max-width: 680px;
        margin-inline: auto;
    }

    .extra-features--fallback .extra-station {
        min-height: 350px;
        grid-template-columns: 58px minmax(0, 1fr);
    }

    .extra-number {
        font-size: 4.25rem;
    }

    .extra-copy h3 {
        font-size: 2.1rem;
    }

    .extra-drawing {
        width: 220px;
        opacity: 0.9;
    }
}

@media (max-width: 600px) {
    .extra-features--fallback {
        padding: 56px 12px;
    }

    .extra-features--fallback .extra-heading {
        margin-bottom: 24px;
    }

    .extra-features--fallback .extra-station {
        min-height: 390px;
        grid-template-columns: 48px minmax(0, 1fr);
        gap: 8px;
    }

    .extra-number {
        font-size: 3.35rem;
    }

    .extra-copy h3 {
        font-size: 1.75rem;
    }

    .extra-copy p {
        font-size: 0.98rem;
    }

    .extra-drawing {
        width: 190px;
        right: 4px;
    }
}

/* Final progress and personal records showcase */
.final-progress-section {
    position: relative;
    min-height: 100svh;
    display: grid;
    align-items: center;
    overflow: hidden;
    background:
        radial-gradient(circle at 82% 48%, rgba(124, 134, 255, 0.16), transparent 30%),
        radial-gradient(circle at 18% 78%, rgba(255, 210, 63, 0.07), transparent 24%),
        #0B0D17;
}

.final-progress-glow {
    position: absolute;
    width: 420px;
    height: 420px;
    right: 8%;
    top: 50%;
    transform: translateY(-50%);
    border-radius: 50%;
    background: radial-gradient(circle, rgba(124, 134, 255, 0.18), rgba(255, 210, 63, 0.05) 42%, transparent 72%);
    filter: blur(18px);
}

.final-progress-container {
    position: relative;
    z-index: 1;
    min-height: 100svh;
    display: grid;
    grid-template-columns: minmax(0, 0.92fr) minmax(420px, 1.08fr);
    align-items: center;
    gap: clamp(36px, 6vw, 96px);
    padding-top: 100px;
    padding-bottom: 64px;
}

.final-copy {
    min-width: 0;
}

.final-eyebrow {
    margin: 0 0 14px;
    color: #FFD23F;
    font-weight: 900;
    letter-spacing: 0.14em;
    text-transform: uppercase;
}

.final-title {
    max-width: 680px;
    margin: 0;
    line-height: 1.02;
}

.final-description {
    max-width: 590px;
    margin: 22px 0 28px;
    color: #BFC4E6;
    line-height: 1.65;
}

.record-highlights {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 30px;
}

.record-highlight {
    min-width: 112px;
    display: flex;
    flex-direction: column;
    gap: 4px;
    padding: 14px 16px;
    border-left: 2px solid #7C86FF;
}

.record-highlight strong {
    color: #FFD23F;
    font-size: 1.35rem;
}

.record-highlight span {
    color: #BFC4E6;
    font-size: 0.82rem;
}

.final-cta {
    min-width: 190px;
    min-height: 54px;
    padding-inline: 34px;
    font-weight: 900;
    box-shadow: 0 16px 38px rgba(124, 134, 255, 0.24);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.final-cta:hover {
    transform: translateY(-3px);
    box-shadow: 0 20px 48px rgba(124, 134, 255, 0.36);
}

.record-visual {
    position: relative;
    min-height: 430px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 34px;
    border: 1px solid rgba(124, 134, 255, 0.22);
    border-top: 4px solid #FFD23F;
    background:
        linear-gradient(145deg, rgba(29, 34, 56, 0.72), rgba(20, 24, 41, 0.92)),
        #141829;
    box-shadow: 0 26px 70px rgba(4, 6, 18, 0.48), 0 0 44px rgba(124, 134, 255, 0.08);
}

.record-visual-top {
    display: flex;
    justify-content: space-between;
    gap: 16px;
    color: #BFC4E6;
    font-size: 0.82rem;
    font-weight: 800;
    letter-spacing: 0.08em;
    text-transform: uppercase;
}

.record-status {
    color: #0A0C2E;
    background: #FFD23F;
    border-radius: 999px;
    padding: 7px 12px;
}

.record-score {
    display: flex;
    align-items: baseline;
    gap: 8px;
    color: #E9EBFA;
}

.record-score strong {
    color: #FFD23F;
    font-size: clamp(5rem, 9vw, 8.5rem);
    line-height: 0.82;
}

.record-score span {
    color: #8E94B8;
    font-size: 1.4rem;
}

.record-line {
    width: 100%;
    height: 180px;
}

.record-grid {
    stroke: rgba(233, 235, 250, 0.08);
    stroke-width: 2;
}

.record-progress-line {
    stroke: #7C86FF;
    stroke-width: 8;
    stroke-linecap: round;
}

.record-point {
    fill: #FFD23F;
    stroke: #0B0D17;
    stroke-width: 5;
}

@media (max-width: 959px) {
    .final-progress-section,
    .final-progress-container {
        min-height: auto;
    }

    .final-progress-container {
        grid-template-columns: 1fr;
        gap: 42px;
        padding-top: 88px;
        padding-bottom: 72px;
    }

    .final-copy {
        text-align: center;
        margin-inline: auto;
    }

    .final-title,
    .final-description {
        margin-inline: auto;
    }

    .record-highlights {
        justify-content: center;
    }

    .record-highlight {
        text-align: left;
    }

    .record-visual {
        width: min(100%, 620px);
        min-height: 390px;
        margin-inline: auto;
    }
}

@media (max-width: 600px) {
    .final-progress-container {
        padding-inline: 16px;
        padding-top: 72px;
        padding-bottom: 56px;
    }

    .record-highlights {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 6px;
    }

    .record-highlight {
        min-width: 0;
        padding: 12px 8px;
    }

    .record-highlight span {
        line-height: 1.3;
    }

    .record-visual {
        min-height: 330px;
        padding: 22px;
    }

    .record-score strong {
        font-size: 5rem;
    }
}
</style>