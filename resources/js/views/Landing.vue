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
                class="core-mascot"
                src="/images/mascot/workout_log_peng.png"
                alt=""
                draggable="false"
              />
            </div>

            <div class="core-visual measurement-stage" data-core-visual="1">
              <div class="visual-glow"></div>
              <img
                class="core-mascot"
                src="/images/mascot/measurements_peng.png"
                alt=""
                draggable="false"
              />
            </div>

            <div class="core-visual macro-stage" data-core-visual="2">
              <div class="visual-glow"></div>
              <img
                class="core-mascot"
                src="/images/mascot/calculation_peng.png"
                alt=""
                draggable="false"
              />
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
            <h2 class="final-title text-headline-large font-weight-bold" data-final-reveal>
              {{ $t('landing.finalSection.title') }}
            </h2>
            <p class="final-description text-body-medium" data-final-reveal>
              {{ $t('landing.finalSection.description') }}
            </p>

            <div class="record-highlights" data-final-reveal>
              <div class="record-highlight">
                <strong>{{ $t('landing.finalSection.prsValue') }}</strong>
                <span>{{ $t('landing.finalSection.prsLabel') }}</span>
              </div>
              <div class="record-highlight">
                <strong>{{ $t('landing.finalSection.strengthValue') }}</strong>
                <span>{{ $t('landing.finalSection.strengthLabel') }}</span>
              </div>
              <div class="record-highlight">
                <strong>{{ $t('landing.finalSection.streakValue') }}</strong>
                <span>{{ $t('landing.finalSection.streakLabel') }}</span>
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
            <p class="final-reassurance">
              {{ $t('landing.finalSection.reassurance') }}
            </p>
          </div>

          <div class="record-showcase">
            <div
              class="record-visual"
              data-final-reveal
              :aria-label="$t('landing.finalSection.latestPr')"
            >
              <div class="record-visual-top">
                <span>{{ $t('landing.finalSection.latestPr') }}</span>
                <span ref="recordBadgeRef" class="record-status">{{ $t('landing.finalSection.newPr') }}</span>
              </div>
              <div class="record-summary">
                <div class="record-details">
                  <p class="record-exercise">{{ $t('landing.finalSection.exercise') }}</p>
                  <div class="record-score">
                    <strong ref="recordCountRef">120</strong>
                    <span>kg</span>
                  </div>
                  <p class="record-delta">{{ $t('landing.finalSection.progressDelta') }}</p>
                  <p class="record-milestone">{{ $t('landing.finalSection.milestone') }}</p>
                </div>
                <img
                  class="result-mascot"
                  src="/images/mascot/result_peng.png"
                  alt=""
                  draggable="false"
                />
              </div>
              <svg class="record-line" viewBox="0 0 480 220" preserveAspectRatio="none" fill="none" aria-hidden="true">
                <defs>
                  <linearGradient id="record-area-gradient" x1="0" y1="30" x2="0" y2="190" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#7C86FF" stop-opacity="0.34" />
                    <stop offset="1" stop-color="#7C86FF" stop-opacity="0" />
                  </linearGradient>
                </defs>
                <path class="record-grid" d="M28 42H460 M28 82H460 M28 122H460 M28 162H460 M28 190H460" />
                <path class="record-axis-ticks" d="M28 190V198 M112 190V198 M196 190V198 M280 190V198 M364 190V198 M452 190V198" />
                <path class="record-area" d="M28 166 C62 166 82 145 112 149 S166 126 196 137 S250 99 280 116 S334 76 364 87 S420 49 452 40 L452 190 L28 190 Z" />
                <path class="record-progress-line" d="M28 166 C62 166 82 145 112 149 S166 126 196 137 S250 99 280 116 S334 76 364 87 S420 49 452 40" />
                <circle class="record-data-point" cx="28" cy="166" r="4" />
                <circle class="record-data-point" cx="112" cy="149" r="4" />
                <circle class="record-data-point" cx="196" cy="137" r="4" />
                <circle class="record-data-point" cx="280" cy="116" r="4" />
                <circle class="record-data-point" cx="364" cy="87" r="4" />
                <text class="record-month" x="28" y="215" text-anchor="start">{{ $t('landing.finalSection.monthJun') }}</text>
                <text class="record-month" x="196" y="215" text-anchor="middle">{{ $t('landing.finalSection.monthAug') }}</text>
                <text class="record-month" x="364" y="215" text-anchor="middle">{{ $t('landing.finalSection.monthOct') }}</text>
                <text class="record-month" x="452" y="215" text-anchor="end">{{ $t('landing.finalSection.monthNov') }}</text>
                <path class="record-callout-leader" d="M410 31L448 41" />
                <g class="record-callout">
                  <rect x="306" y="4" width="108" height="26" rx="8" />
                  <text x="360" y="21" text-anchor="middle">{{ $t('landing.finalSection.peakLabel') }}</text>
                </g>
                <circle class="record-point" cx="452" cy="40" r="8" />
              </svg>
            </div>
          </div>
        </v-container>
      </section>
    </div>
  </transition>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount, nextTick } from 'vue'
import { onBeforeRouteLeave } from 'vue-router'
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
const recordCountRef = ref(null)
const recordBadgeRef = ref(null)

let gsapContext = null
let floatTween = null
let removeCursorTracking = null
const timers = []

const cleanupAnimations = () => {
    timers.forEach(clearTimeout)
    timers.length = 0
    removeCursorTracking?.()
    removeCursorTracking = null
    floatTween?.kill()
    floatTween = null
    gsapContext?.revert()
    gsapContext = null
    ScrollTrigger.getAll().forEach(trigger => trigger.kill(true))

    const appContainers = [
        document.documentElement,
        document.body,
        document.querySelector('#app'),
        document.querySelector('.v-main'),
    ]
    appContainers.forEach(element => element?.style.removeProperty('transform'))
}

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

                // Keep the desktop visual stage cleanly clipped during horizontal scene swipes.
                const visualStage = coreFeaturesRef.value.querySelector('.core-visuals')
                visualStage.style.overflow = 'hidden'

                const steps = gsap.utils.toArray('[data-core-step]')
                const visuals = gsap.utils.toArray('[data-core-visual]')
                const progress = '.core-progress-fill'

                gsap.set(visuals.slice(1), { autoAlpha: 0, xPercent: 60, y: 0, scale: 1 })
                gsap.set(visuals[0], { autoAlpha: 1, xPercent: 0, y: 0, scale: 1 })
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
                        scrub: 0.8,
                        invalidateOnRefresh: true,
                        onUpdate: self => {
                            gsap.set(progress, { scaleX: self.progress })

                            // Shared thresholds prevent the left step and right visual from diverging.
                            const activeIndex = self.progress < (1 / 3)
                                ? 0
                                : self.progress < (2 / 3)
                                    ? 1
                                    : 2
                            setActiveStep(activeIndex)
                        },
                    },
                })

                // Scene 1 -> 2 and 2 -> 3 hand off at the same boundaries as the steps.
                timeline
                    .set(visuals[0], { autoAlpha: 1, xPercent: 0, y: 0, scale: 1 })
                    .set(visuals.slice(1), { autoAlpha: 0, xPercent: 60, y: 0, scale: 1 })
                    .to(visuals[0], { autoAlpha: 0, xPercent: -60, ease: 'power2.inOut', duration: 0.12 }, 1 / 3)
                    .to(visuals[1], { autoAlpha: 1, xPercent: 0, ease: 'power2.inOut', duration: 0.12 }, 1 / 3)
                    .to(visuals[1], { autoAlpha: 0, xPercent: -60, ease: 'power2.inOut', duration: 0.12 }, 2 / 3)
                    .to(visuals[2], { autoAlpha: 1, xPercent: 0, ease: 'power2.inOut', duration: 0.12 }, 2 / 3)
                    .set(visuals[2], { autoAlpha: 1, xPercent: 0, y: 0, scale: 1 }, 1)

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

                return () => {
                    const visualStage = coreFeaturesRef.value.querySelector('.core-visuals')
                    visualStage.style.removeProperty('overflow')
                    timeline.scrollTrigger?.kill()
                    timeline.kill()
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

            media.add('(prefers-reduced-motion: no-preference)', () => {
                const finalReveal = gsap.utils.toArray('[data-final-reveal]', finalSectionRef.value)
                const recordLine = finalSectionRef.value.querySelector('.record-progress-line')
                const recordArea = finalSectionRef.value.querySelector('.record-area')
                const recordPoints = gsap.utils.toArray('.record-data-point, .record-point', finalSectionRef.value)
                const recordCallout = finalSectionRef.value.querySelector('.record-callout')
                const recordCalloutLeader = finalSectionRef.value.querySelector('.record-callout-leader')
                const countProxy = { value: 0 }

                gsap.set(finalReveal, { opacity: 0, y: 30 })
                gsap.set(recordPoints, { scale: 0, transformOrigin: 'center' })
                gsap.set([recordArea, recordCallout, recordCalloutLeader, recordBadgeRef.value], { opacity: 0 })
                gsap.set(recordBadgeRef.value, { scale: 0.88, transformOrigin: 'center' })

                if (recordLine) {
                    const lineLength = recordLine.getTotalLength()
                    gsap.set(recordLine, { strokeDasharray: lineLength, strokeDashoffset: lineLength })
                }

                const finalTimeline = gsap.timeline({
                    scrollTrigger: {
                        trigger: finalSectionRef.value,
                        start: 'top 78%',
                        once: true,
                    },
                })

                finalTimeline
                    .to(finalReveal, { opacity: 1, y: 0, duration: 0.75, stagger: 0.09, ease: 'power3.out' })
                    .to(countProxy, {
                        value: 120,
                        duration: 1.15,
                        snap: { value: 1 },
                        ease: 'power2.out',
                        onUpdate: () => {
                            if (recordCountRef.value) {
                                recordCountRef.value.textContent = Math.round(countProxy.value).toString()
                            }
                        },
                    }, 0.12)
                    .to(recordLine, { strokeDashoffset: 0, duration: 1.2, ease: 'power2.out' }, 0.2)
                    .to(recordArea, { opacity: 1, duration: 1, ease: 'power1.out' }, 0.25)
                    .to(recordBadgeRef.value, { opacity: 1, scale: 1, duration: 0.45, ease: 'back.out(1.7)' }, 0.35)
                    .to([recordCallout, recordCalloutLeader], { opacity: 1, duration: 0.35 }, 0.65)
                    .to(recordPoints, { opacity: 1, scale: 1, duration: 0.35, stagger: 0.08, ease: 'back.out(1.5)' }, 0.68)

                return () => finalTimeline.kill()
            })
        })
    }, 300))
})

onBeforeRouteLeave(cleanupAnimations)
onBeforeUnmount(cleanupAnimations)
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
    transition: none
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

.core-mascot {
    position: relative;
    z-index: 1;
    width: min(100%, 520px);
    height: auto;
    max-height: min(540px, 66vh);
    object-fit: contain;
    filter: drop-shadow(0 28px 38px rgba(0, 0, 0, 0.38));
}

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
    background: radial-gradient(circle, rgba(124, 134, 255, 0.18), transparent 70%);
    filter: blur(18px);
}

.final-progress-container {
    position: relative;
    z-index: 1;
    min-height: 100svh;
    display: grid;
    grid-template-columns: repeat(12, minmax(0, 1fr));
    align-items: center;
    column-gap: clamp(20px, 2.4vw, 36px);
    row-gap: 36px;
    padding-block: clamp(56px, 8vh, 88px);
}

.final-copy {
    grid-column: 1 / span 5;
    min-width: 0;
}

.final-eyebrow {
    margin: 0 0 14px;
    color: #7C86FF;
    font-weight: 900;
    letter-spacing: 0.14em;
    text-transform: uppercase;
}

.final-title {
    width: calc(100% + clamp(24px, 3vw, 48px));
    max-width: 720px;
    margin: 0;
    font-size: clamp(2.4rem, 3.2vw, 3rem);
    line-height: 0.98;
    letter-spacing: -0.02em;
}

.final-description {
    max-width: 590px;
    margin: 22px 0 28px;
    color: #BFC4E6;
    line-height: 1.65;
}

.record-highlights {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: clamp(12px, 1.6vw, 22px);
    margin-bottom: 30px;
}

.record-highlight {
    min-width: 0;
    display: flex;
    flex-direction: column;
    gap: 6px;
    padding: 8px 0;
}

.record-highlight strong {
    color: #E9EBFA;
    font-size: clamp(1.05rem, 1.6vw, 1.4rem);
    line-height: 1;
    white-space: nowrap;
}

.record-highlight:nth-child(2) strong {
    transform: scale(1.08);
    transform-origin: left center;
    font-weight: 900;
}

.record-highlight span {
    color: #BFC4E6;
    font-size: 0.8rem;
    line-height: 1.3;
}

.final-reassurance {
    margin-top: 12px;
    color: rgba(191, 196, 230, 0.84);
    font-size: 0.84rem;
}

.final-cta {
    min-width: 190px;
    min-height: 54px;
    padding-inline: 34px;
    color: #FFFFFF;
    background-color: #5965D8;
    border: 1px solid rgba(233, 235, 250, 0.24);
    background-image: linear-gradient(135deg, rgba(233, 235, 250, 0.12), transparent 58%);
    font-weight: 900;
    letter-spacing: 0.02em;
    box-shadow: 0 16px 38px rgba(124, 134, 255, 0.24);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.final-cta:hover {
    transform: translateY(-3px);
    box-shadow: 0 20px 48px rgba(124, 134, 255, 0.36);
}

.final-cta:focus-visible {
    outline: 3px solid #E9EBFA;
    outline-offset: 3px;
}

.record-showcase {
    grid-column: 7 / -1;
    min-width: 0;
}

.record-visual {
    position: relative;
    isolation: isolate;
    overflow: hidden;
    min-width: 0;
    min-height: 540px;
    display: flex;
    flex-direction: column;
    padding: clamp(24px, 2.8vw, 36px);
    padding-bottom: 28px;
    border: 1px solid rgba(124, 134, 255, 0.22);
    border-top: 4px solid transparent;
    background:
        linear-gradient(145deg, rgba(29, 34, 56, 0.72), rgba(20, 24, 41, 0.92)),
        #141829;
    box-shadow: 0 26px 70px rgba(4, 6, 18, 0.48), 0 0 44px rgba(124, 134, 255, 0.08);
}

.record-visual::before {
    content: '';
    position: absolute;
    z-index: -1;
    top: -90px;
    right: -80px;
    width: 360px;
    aspect-ratio: 1;
    border-radius: 50%;
    background:
        radial-gradient(circle, rgba(124, 134, 255, 0.22), transparent 68%);
    filter: blur(14px);
    pointer-events: none;
}

.record-visual::after {
    content: '';
    position: absolute;
    z-index: 3;
    inset: 0 0 auto;
    height: 4px;
    background: linear-gradient(90deg, #7C86FF, #FFD23F);
    pointer-events: none;
}

.record-visual-top {
    position: relative;
    z-index: 2;
    display: grid;
    grid-template-columns: minmax(0, 1fr) max-content;
    align-items: center;
    gap: 16px;
    color: #BFC4E6;
    font-size: clamp(0.7rem, 0.82vw, 0.82rem);
    font-weight: 800;
    letter-spacing: 0.06em;
    text-transform: uppercase;
}

.record-visual-top > span:first-child {
    min-width: 0;
    line-height: 1.35;
}

.record-status {
    justify-self: end;
    white-space: nowrap;
    color: #0A0C2E;
    background: #FFD23F;
    border-radius: 999px;
    padding: 8px 14px;
    line-height: 1;
}

.record-summary {
    position: relative;
    min-height: 220px;
    padding-top: 20px;
}

.record-details {
    position: relative;
    z-index: 2;
    width: 55%;
}

.record-exercise {
    margin: 0 0 8px;
    color: #E9EBFA;
    font-size: 0.9rem;
    font-weight: 800;
    letter-spacing: 0.11em;
    text-transform: uppercase;
}

.record-score {
    display: flex;
    align-items: baseline;
    gap: 10px;
    color: #E9EBFA;
}

.record-score strong {
    color: #FFD23F;
    font-size: clamp(4.5rem, 6.6vw, 6.75rem);
    line-height: 0.88;
    white-space: nowrap;
}

.record-score span {
    color: #8E94B8;
    font-size: 1.5rem;
}

.record-delta {
    margin: 10px 0 0;
    color: #BFC4E6;
    font-size: 0.92rem;
    font-weight: 700;
}

.record-milestone {
    margin: 7px 0 0;
    color: rgba(191, 196, 230, 0.72);
    font-size: 0.76rem;
    letter-spacing: 0.06em;
    text-transform: uppercase;
}

.record-milestone::before {
    content: '';
    display: inline-block;
    width: 6px;
    height: 6px;
    margin: 0 8px 1px 0;
    border-radius: 50%;
    background: #7C86FF;
}

.result-mascot {
    position: absolute;
    z-index: 1;
    top: 20px;
    right: 0;
    display: block;
    width: clamp(150px, 12vw, 190px);
    height: auto;
    object-fit: contain;
    pointer-events: none;
    filter:
        drop-shadow(0 18px 30px rgba(124, 134, 255, 0.26));
}

.record-line {
    position: relative;
    z-index: 2;
    display: block;
    width: 100%;
    height: 230px;
    margin-top: auto;
    overflow: visible;
}

.record-grid {
    stroke: rgba(233, 235, 250, 0.08);
    stroke-width: 1.5;
}

.record-axis-ticks {
    stroke: rgba(233, 235, 250, 0.2);
    stroke-width: 1.5;
    stroke-linecap: round;
}

.record-area {
    fill: url(#record-area-gradient);
}

.record-progress-line {
    stroke: #7C86FF;
    stroke-width: 5;
    stroke-linecap: round;
    stroke-linejoin: round;
}

.record-data-point {
    fill: #7C86FF;
    stroke: #141829;
    stroke-width: 2;
}

.record-callout-leader {
    stroke: rgba(124, 134, 255, 0.72);
    stroke-width: 1.5;
}

.record-point {
    fill: #FFD23F;
    stroke: #141829;
    stroke-width: 4;
}

.record-callout rect {
    fill: #242943;
    stroke: rgba(124, 134, 255, 0.55);
    stroke-width: 1;
}

.record-callout text {
    fill: #FFD23F;
    font-family: inherit;
    font-size: 12px;
    font-weight: 800;
}

.record-month {
    fill: rgba(191, 196, 230, 0.72);
    font-family: inherit;
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 0.04em;
}

@media (max-width: 1199px) {
    .final-progress-section,
    .final-progress-container {
        min-height: auto;
    }

    .final-progress-container {
        grid-template-columns: repeat(12, minmax(0, 1fr));
        column-gap: clamp(12px, 2vw, 24px);
        row-gap: 42px;
        padding-block: clamp(56px, 8vh, 88px);
    }

    .final-copy {
        grid-column: 2 / span 10;
        width: 100%;
        text-align: center;
    }

    .final-title,
    .final-description {
        margin-inline: auto;
    }

    .record-highlights {
        width: 100%;
        max-width: 680px;
        margin-inline: auto;
    }

    .record-highlight {
        text-align: left;
    }

    .record-showcase {
        grid-column: 2 / span 10;
    }
}

@media (max-width: 600px) {
    .final-progress-container {
        padding-inline: 16px;
        padding-block: clamp(48px, 8vh, 64px);
    }

    .final-copy,
    .record-showcase {
        grid-column: 1 / -1;
    }

    .final-title {
        width: 100%;
        font-size: clamp(2rem, 8vw, 2.2rem);
        line-height: 1.05;
    }

    .record-highlight {
        padding: 8px 0;
    }

    .record-highlight span {
        line-height: 1.3;
    }

    .record-visual {
        min-height: 500px;
        padding: 22px;
        padding-bottom: 22px;
    }

    .result-mascot {
        top: 28px;
        right: 0;
        width: 36%;
    }

    .record-summary {
        min-height: 205px;
    }

    .record-details {
        width: 56%;
    }

    .record-visual-top {
        gap: 10px;
    }

    .record-score strong {
        font-size: 4.5rem;
    }

    .record-score span {
        font-size: 1.25rem;
    }

    .record-delta {
        font-size: 0.82rem;
    }

    .record-milestone {
        font-size: 0.66rem;
        letter-spacing: 0.03em;
    }

    .record-line {
        height: 200px;
    }
}

@media (prefers-reduced-motion: reduce) {
    .final-cta {
        transition: none;
    }

    .final-cta:hover {
        transform: none;
    }
}
</style>