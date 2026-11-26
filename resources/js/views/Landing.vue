<template>
  <transition name="page-fade">
    <div v-if="showPage">
      <!-- Hero introduces the tracker and leads visitors to sign up. -->
      <div class="hero" ref="heroRef">
        <v-container class="hero-container">
            <div class="hero-content">
                <p class="hero-eyebrow" data-hero-line>
                    {{ $t('landing.heroEyebrow') }}
                </p>
                <h1 class="hero-title font-weight-black">
                    <span class="hero-title-line" data-hero-line>{{ $t('landing.heroLine1') }}</span>
                    <span class="hero-title-line hero-title-accent" data-hero-line>{{ $t('landing.heroLine2') }}</span>
                </h1>
                <p class="hero-subcopy" data-hero-line>
                    {{ $t('landing.heroSubcopy') }}
                </p>

                <div class="hero-actions">
                    <router-link to="/register" class="text-decoration-none">
                        <v-btn
                            ref="heroCtaRef"
                            class="hero-cta primary-cta"
                            color="primary"
                            size="large"
                            rounded="lg"
                            elevation="0"
                        >
                            {{ $t('landing.startTracking') }}
                        </v-btn>
                    </router-link>
                    <p class="hero-reassurance">
                        {{ $t('landing.heroReassurance') }}
                    </p>
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

      <!-- Core Features pairs each product benefit with a matching mascot scene. -->
      <section ref="coreFeaturesRef" class="core-features">
        <v-container class="core-showcase">
          <div class="core-copy">
            <div class="core-heading">
              <p class="core-eyebrow text-label-medium">{{ $t('landing.coreFeatures') }}</p>
              <h2 class="text-headline-small font-weight-bold">
                {{ $t('landing.coreFeaturesSubtitlePrefix') }}<span class="core-heading-accent">{{ $t('landing.coreFeaturesSubtitleAccent') }}</span>{{ $t('landing.coreFeaturesSubtitleSuffix') }}
              </h2>
            </div>

            <div class="core-progress" aria-hidden="true">
              <span class="core-progress-fill"></span>
            </div>

            <div class="core-steps">
              <article
                v-for="(feature, index) in coreFeatures"
                :key="feature.key"
                class="core-step"
                :class="{ 'is-active': index === 0 }"
                :data-core-step="index"
              >
                <span class="core-step-number">{{ feature.number }}</span>
                <div class="core-step-copy">
                  <h3 class="text-title-medium font-weight-bold">
                    {{ $t(feature.title) }}
                  </h3>
                  <p class="text-body-medium text-medium-emphasis">
                    {{ $t(feature.text) }}
                  </p>
                </div>
                <div class="core-inline-visual" aria-hidden="true">
                  <div class="visual-glow"></div>
                  <img
                    class="core-mascot"
                    :src="feature.image"
                    alt=""
                    draggable="false"
                  />
                </div>
              </article>
            </div>
          </div>

          <div class="core-visuals features-stage" aria-live="polite">
            <div
              v-for="(feature, index) in coreFeatures"
              :key="feature.key"
              class="core-visual"
              :class="{ 'is-active': index === 0 }"
              :data-core-visual="index"
            >
              <div class="visual-glow"></div>
              <img
                class="core-mascot"
                :src="feature.image"
                alt=""
                draggable="false"
              />
            </div>
          </div>
        </v-container>
      </section>

      <!-- Extra Features presents five benefits along a horizontal scroll track. -->
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

        <div ref="extraTrackRef" class="extra-track">
          <article class="extra-station" data-extra-station="0">
            <span class="extra-number">01</span>
            <div class="extra-copy">
              <h3>{{ $t('landing.extraFeatures.oneRm.title') }}</h3>
              <p>{{ $t('landing.extraFeatures.oneRm.text') }}</p>
              <span class="extra-tag">{{ $t('landing.extraFeatures.oneRm.tag') }}</span>
            </div>
            <svg class="extra-drawing" viewBox="0 0 300 220" fill="none" aria-hidden="true">
              <path class="draw-path indigo" d="M55 178 A95 95 0 0 1 245 178 M55 178 H245" />
              <path class="draw-path indigo" d="M73 178 L61 178 M79 130 L68 124 M113 96 L107 85 M150 83 V69 M187 96 L193 85 M221 130 L232 124 M227 178 H239" />
              <path class="draw-path gold" d="M150 178 L207 108" />
              <circle class="draw-dot indigo" cx="150" cy="178" r="8" />
              <circle class="draw-dot gold" cx="207" cy="108" r="10" />
              <text class="gauge-label" x="150" y="157">1RM</text>
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
              <path class="draw-path indigo" d="M72 22 H183 L228 67 V198 H72 Z M183 22 V67 H228" />
              <path class="draw-path gold" d="M98 54 H158" />
              <path class="draw-path" d="M99 88 H116 V105 H99 Z M99 130 H116 V147 H99 Z M99 172 H116 V189 H99 Z" />
              <path class="draw-path gold" d="M102 96 L107 101 L114 91 M102 138 L107 143 L114 133 M102 180 L107 185 L114 175" />
              <path class="draw-path indigo" d="M133 96 H200 M133 138 H200 M133 180 H200" />
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

      <!-- Final section pairs progress proof with one last signup prompt. -->
      <section ref="finalSectionRef" class="final-progress-section">
        <div class="final-progress-glow" aria-hidden="true"></div>

        <v-container class="final-progress-container">
          <div class="final-copy">
            <p class="final-eyebrow text-label-medium" data-final-reveal>
              {{ $t('landing.finalSection.eyebrow') }}
            </p>
            <h2 class="final-title text-headline-large font-weight-bold" data-final-reveal>
              {{ $t('landing.finalSection.titlePrefix') }}<span class="final-title-accent">{{ $t('landing.finalSection.titleAccent') }}</span>{{ $t('landing.finalSection.titleSuffix') }}
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
                class="final-cta primary-cta"
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
              <!-- SVG chart elements are drawn and revealed as this section enters view. -->
              <div class="record-chart">
                <svg class="record-line" viewBox="0 0 480 220" preserveAspectRatio="xMidYMid meet" fill="none" aria-hidden="true">
                  <defs>
                    <linearGradient id="record-area-gradient" x1="0" y1="30" x2="0" y2="190" gradientUnits="userSpaceOnUse">
                      <stop stop-color="rgb(var(--v-theme-primary))" stop-opacity="0.34" />
                      <stop offset="1" stop-color="rgb(var(--v-theme-primary))" stop-opacity="0" />
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
                  <circle class="record-point" cx="452" cy="40" r="8" />
                </svg>
                <span class="record-callout-badge">{{ $t('landing.finalSection.peakLabel') }}</span>
              </div>
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
const coreFeatures = [
    {
        key: 'workoutLogging',
        number: '01',
        title: 'landing.features.workoutLogging.title',
        text: 'landing.features.workoutLogging.text',
        image: '/images/mascot/workout_log_peng.png',
    },
    {
        key: 'bodyMeasurements',
        number: '02',
        title: 'landing.features.bodyMeasurements.title',
        text: 'landing.features.bodyMeasurements.text',
        image: '/images/mascot/measurements_peng.png',
    },
    {
        key: 'macroCalculator',
        number: '03',
        title: 'landing.features.macroCalculator.title',
        text: 'landing.features.macroCalculator.text',
        image: '/images/mascot/calculation_peng.png',
    },
]

// Keep DOM refs for the animated sections and their chart elements.
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
let removeViewportRefresh = null
let resizeRefreshFrame = null
const extraTrackEndPadding = 96
const timers = []

const syncExtraHeadingHeight = () => {
    const heading = extraFeaturesRef.value?.querySelector('.extra-heading')
    if (!heading) return

    extraFeaturesRef.value.style.setProperty(
        '--extra-heading-height',
        `${heading.getBoundingClientRect().height}px`,
    )

}

const refreshOnViewportChange = () => {
    if (resizeRefreshFrame !== null) {
        cancelAnimationFrame(resizeRefreshFrame)
    }

    resizeRefreshFrame = requestAnimationFrame(() => {
        resizeRefreshFrame = null
        syncExtraHeadingHeight()
        ScrollTrigger.refresh()
    })
}

const animateExtraStationDrawing = (station, triggerOptions) => {
    const drawing = station.querySelector('.extra-drawing')
    const paths = drawing.querySelectorAll('.draw-path, .draw-bar')
    const dots = drawing.querySelectorAll('.draw-dot')

    paths.forEach(path => {
        const length = path.getTotalLength()
        gsap.set(path, { strokeDasharray: length, strokeDashoffset: length })
    })
    gsap.set(dots, { scale: 0.65, transformOrigin: 'center' })

    const reveal = gsap.timeline({
        scrollTrigger: {
            trigger: station,
            ...triggerOptions,
        },
    })

    reveal
        .to(paths, {
            strokeDashoffset: 0,
            duration: 0.85,
            stagger: 0.03,
            ease: 'power2.out',
        })
        .to(dots, {
            scale: 1,
            duration: 0.35,
            stagger: 0.04,
            ease: 'power2.out',
        }, 0)
}

const animateExtraStationText = (station, triggerOptions) => {
    const textElements = station.querySelectorAll(
        '.extra-number, .extra-copy h3, .extra-copy p, .extra-tag',
    )
    gsap.set(textElements, { opacity: 0, y: 16 })

    const reveal = gsap.timeline({
        scrollTrigger: {
            trigger: station,
            ...triggerOptions,
        },
    })

    reveal.to(textElements, {
        opacity: 1,
        y: 0,
        duration: 1,
        stagger: 0.08,
        ease: 'power2.out',
    })
}

// Release listeners, timelines, triggers, and transforms when leaving the page.
const cleanupAnimations = () => {
    timers.forEach(clearTimeout)
    timers.length = 0
    removeCursorTracking?.()
    removeCursorTracking = null
    removeViewportRefresh?.()
    removeViewportRefresh = null
    if (resizeRefreshFrame !== null) {
        cancelAnimationFrame(resizeRefreshFrame)
        resizeRefreshFrame = null
    }
    floatTween?.kill()
    floatTween = null
    gsapContext?.revert()
    gsapContext = null
    // Remove pinned layout effects that could otherwise carry into the next route.
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
    // Wait for the delayed page content to render before selecting animation targets.
    timers.push(setTimeout(async () => {
        showPage.value = true
        await nextTick()

        gsapContext = gsap.context(() => {
            syncExtraHeadingHeight()
            window.addEventListener('resize', refreshOnViewportChange)
            window.addEventListener('orientationchange', refreshOnViewportChange)
            removeViewportRefresh = () => {
                window.removeEventListener('resize', refreshOnViewportChange)
                window.removeEventListener('orientationchange', refreshOnViewportChange)
            }

            const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches

            // Keep the Hero visible without motion when the visitor requests it.
            if (reducedMotion) {
                gsap.set(['[data-hero-line]', '.hero-cta', '.hero-reassurance', '.mascot-stage'], {
                    opacity: 1,
                    y: 0,
                    x: 0,
                    rotate: 0,
                })
            } else {
                // Bring in the Hero copy, CTA, and mascot, then add subtle mascot motion.
                const entrance = gsap.timeline({ defaults: { ease: 'power3.out' } })
                entrance
                    .from('[data-hero-line]', { y: 28, opacity: 0, stagger: 0.12, duration: 0.75 })
                    .from('.hero-cta, .hero-reassurance', { y: -18, opacity: 0, duration: 0.55 }, '-=0.35')
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

                // Limit pointer-driven mascot tilt to precise desktop pointers.
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

            // Pin and animate the Core Features stage only on desktop.
            media.add('(min-width: 960px) and (prefers-reduced-motion: no-preference)', () => {
                const visualStage = coreFeaturesRef.value.querySelector('.features-stage')
                const steps = gsap.utils.toArray('[data-core-step]', coreFeaturesRef.value)
                const visuals = gsap.utils.toArray('[data-core-visual]', coreFeaturesRef.value)
                const progress = '.core-progress-fill'

                visualStage.style.overflow = 'hidden'
                gsap.set(visuals.slice(1), { autoAlpha: 0, xPercent: 60, y: 0, scale: 1 })
                gsap.set(visuals[0], { autoAlpha: 1, xPercent: 0, y: 0, scale: 1 })
                gsap.set(progress, { scaleX: 0 })

                const setActiveStep = index => {
                    steps.forEach((step, stepIndex) => {
                        step.classList.toggle('is-active', stepIndex === index)
                    })
                }

                setActiveStep(0)

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

                timeline
                    .set(visuals[0], { autoAlpha: 1, xPercent: 0, y: 0, scale: 1 })
                    .set(visuals.slice(1), { autoAlpha: 0, xPercent: 60, y: 0, scale: 1 })
                    .to(visuals[0], { autoAlpha: 0, xPercent: -60, ease: 'power2.inOut', duration: 0.12 }, 1 / 3)
                    .to(visuals[1], { autoAlpha: 1, xPercent: 0, ease: 'power2.inOut', duration: 0.12 }, 1 / 3)
                    .to(visuals[1], { autoAlpha: 0, xPercent: -60, ease: 'power2.inOut', duration: 0.12 }, 2 / 3)
                    .to(visuals[2], { autoAlpha: 1, xPercent: 0, ease: 'power2.inOut', duration: 0.12 }, 2 / 3)
                    .set(visuals[2], { autoAlpha: 1, xPercent: 0, y: 0, scale: 1 }, 1)

                return () => {
                    visualStage.style.removeProperty('overflow')
                    timeline.scrollTrigger?.kill()
                    timeline.kill()
                }
            })

            // Leave the desktop stage visible but static when motion is reduced.
            media.add('(min-width: 960px) and (prefers-reduced-motion: reduce)', () => {
                const steps = gsap.utils.toArray('[data-core-step]', coreFeaturesRef.value)
                const progress = '.core-progress-fill'
                steps.forEach((step, index) => step.classList.toggle('is-active', index === 0))
                gsap.set(progress, { scaleX: 0 })
            })

            // Fade each mobile card in once, with a separate subtle image entrance.
            media.add('(max-width: 959px) and (prefers-reduced-motion: no-preference)', () => {
                const steps = gsap.utils.toArray('[data-core-step]', coreFeaturesRef.value)

                steps.forEach(step => {
                    const image = step.querySelector('.core-inline-visual')
                    const entrance = gsap.timeline({
                        scrollTrigger: {
                            trigger: step,
                            start: 'top 88%',
                            once: true,
                        },
                    })

                    entrance
                        .from(step, {
                            opacity: 0,
                            y: 24,
                            duration: 0.65,
                            ease: 'power2.out',
                        })
                        .from(image, {
                            opacity: 0,
                            scale: 0.94,
                            duration: 0.7,
                            ease: 'power2.out',
                        }, 0)
                })
            })

            // Keep the horizontal Extra Features track on desktop and reveal each station as it arrives.
            media.add('(min-width: 960px)', () => {
                extraFeaturesRef.value.classList.remove('extra-features--fallback')
                const travel = () => {
                    const sectionWidth = extraFeaturesRef.value.clientWidth
                    const trackWidth = extraTrackRef.value.scrollWidth
                    return Math.max(0, trackWidth - sectionWidth + extraTrackEndPadding)
                }
                const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches
                const stations = gsap.utils.toArray('.extra-station', extraTrackRef.value)

                if (reducedMotion) {
                    gsap.set('.extra-features .draw-path, .extra-features .draw-bar', {
                        clearProps: 'strokeDasharray,strokeDashoffset',
                    })
                    gsap.set('.extra-features .draw-dot', { scale: 1, clearProps: 'transform' })
                }

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

                // Scroll horizontally through the feature track; each SVG draws independently.
                extraTimeline
                    .to(extraTrackRef.value, { x: () => -travel(), ease: 'none' }, 0)
                if (!reducedMotion) {
                    extraTimeline.to(kineticTextRef.value, { x: kineticEnd, ease: 'none' }, 0)
                    stations.forEach((station, index) => {
                        animateExtraStationText(station, {
                            containerAnimation: extraTimeline,
                            start: 'left 90%',
                            end: 'left 65%',
                            scrub: 0.45,
                        })
                        animateExtraStationDrawing(station, {
                            containerAnimation: extraTimeline,
                            start: 'left 75%',
                            end: index === stations.length - 1 ? 'right 92%' : 'right 25%',
                            scrub: 0.45,
                        })
                    })
                }

                return () => {
                    extraTimeline.scrollTrigger?.kill()
                    extraTimeline.kill()
                }
            })

            // Stack Extra Features on mobile and draw each station as it enters view.
            media.add('(max-width: 959px)', () => {
                extraFeaturesRef.value.classList.add('extra-features--fallback')
                gsap.set(extraTrackRef.value, { x: 0, clearProps: 'position' })
                gsap.set(kineticTextRef.value, { x: 0 })
                const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches
                const stations = gsap.utils.toArray('.extra-station', extraTrackRef.value)

                if (reducedMotion) {
                    gsap.set('.extra-features .draw-path, .extra-features .draw-bar', {
                        clearProps: 'strokeDasharray,strokeDashoffset',
                    })
                    gsap.set('.extra-features .draw-dot', { scale: 1, clearProps: 'transform' })
                } else {
                    stations.forEach(station => {
                        animateExtraStationDrawing(station, {
                            start: 'top 78%',
                            once: true,
                        })
                    })
                }

                return () => {
                    extraFeaturesRef.value?.classList.remove('extra-features--fallback')
                }
            })

            // Reveal the final section and animate its record count and chart on scroll.
            media.add('(prefers-reduced-motion: no-preference)', () => {
                const finalReveal = gsap.utils.toArray('[data-final-reveal]', finalSectionRef.value)
                const recordLine = finalSectionRef.value.querySelector('.record-progress-line')
                const recordArea = finalSectionRef.value.querySelector('.record-area')
                const recordPoints = gsap.utils.toArray('.record-data-point, .record-point', finalSectionRef.value)
                const recordCallout = finalSectionRef.value.querySelector('.record-callout-badge')
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
        radial-gradient(circle at 76% 46%, rgba(var(--v-theme-primary), 0.18) 0%, rgba(var(--v-theme-primary), 0.06) 23%, transparent 48%),
        radial-gradient(circle at 18% 18%, rgba(var(--v-theme-secondary), 0.055) 0%, transparent 28%),
        linear-gradient(135deg, rgb(var(--v-theme-surface-bright)) 0%, rgb(var(--v-theme-background)) 62%, rgb(var(--v-theme-background)) 100%);
}

.hero::after {
    content: '';
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    height: 180px;
    pointer-events: none;
    background: linear-gradient(to bottom, transparent 0%, rgba(var(--v-theme-background), 0.88) 72%, rgb(var(--v-theme-background)) 100%);
}

/* Desktop Hero grid: copy on the left, mascot on the right. */
.hero-container {
    position: relative;
    z-index: 1;
    box-sizing: border-box;
    max-width: 1280px;
    min-height: 100svh;
    display: grid;
    grid-template-columns: minmax(0, 1fr) minmax(280px, min(38vw, 460px));
    align-items: center;
    gap: clamp(24px, 4vw, 56px);
    padding: 96px clamp(20px, 4vw, 36px) 32px;
}

.hero-content {
    min-width: 0;
    max-width: 740px;
    text-align: left;
}

.hero-eyebrow {
    margin: 0 0 14px;
    color: rgb(var(--v-theme-primary));
    font-size: 0.76rem;
    font-weight: 900;
    letter-spacing: 0.16em;
    text-transform: uppercase;
}

.hero-title {
    margin: 0;
    font-size: clamp(1.9rem, 4.5vw, 3.1rem);
    line-height: 1.04;
    letter-spacing: -0.035em;
}

.hero-title-line {
    display: block;
}

.hero-title-accent {
    color: rgb(var(--v-theme-secondary));
}

.hero-subcopy {
    max-width: 680px;
    margin: 18px 0 0;
    color: color-mix(in srgb, rgb(var(--v-theme-on-surface)) 55%, rgb(var(--v-theme-subheading)));
    font-size: clamp(1rem, 1.2vw, 1.125rem);
    line-height: 1.5;
}

.hero-content > .hero-actions {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 0;
    margin-top: 52px;
}

.hero-content > .hero-actions > a {
    display: inline-flex;
}

/* Shared button treatment keeps the Hero and final calls to action consistent. */
.primary-cta {
    min-width: 190px;
    width: auto;
    height: 54px;
    min-height: 54px;
    padding-inline: 34px;
    border: 1px solid rgba(var(--v-theme-on-surface), 0.24);
    border-radius: 12px;
    color: rgb(var(--v-theme-on-primary));
    background-color: rgb(var(--v-theme-primary));
    background-image: linear-gradient(135deg, rgba(var(--v-theme-on-surface), 0.12), transparent 58%);
    font-size: 1.125rem;
    font-weight: 900;
    letter-spacing: 0.02em;
    box-shadow: 0 12px 28px rgba(var(--v-theme-primary), 0.18);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.primary-cta:hover {
    transform: translateY(-3px);
    box-shadow: 0 16px 36px rgba(var(--v-theme-primary), 0.28);
}

.primary-cta:focus-visible {
    outline: 3px solid rgb(var(--v-theme-on-surface));
    outline-offset: 3px;
}

.hero-reassurance {
    display: block;
    margin: -10px 0 0;
    color: rgba(var(--v-theme-subheading), 0.76);
    font-size: 0.84rem;
    line-height: 1.15;
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
    width: 92%;
    aspect-ratio: 1;
    border-radius: 50%;
    background:
        radial-gradient(circle at 58% 48%, rgba(var(--v-theme-primary), 0.26) 0%, rgba(var(--v-theme-primary), 0.13) 38%, transparent 68%),
        radial-gradient(circle at 38% 72%, rgba(var(--v-theme-secondary), 0.12) 0%, transparent 42%);
    filter: blur(16px);
    z-index: 0;
}

.mascot-image {
    position: relative;
    z-index: 1;
    display: block;
    width: 90%;
    max-height: min(66vh, 620px);
    object-fit: contain;
    object-position: center;
    user-select: none;
    filter: drop-shadow(0 26px 34px rgba(var(--v-theme-background), 0.34));
}

@media (min-width: 960px) and (max-width: 1199px) {
    .hero-container {
        grid-template-columns: minmax(0, 1fr) minmax(260px, 30vw);
        gap: clamp(24px, 3vw, 36px);
        padding-inline: 24px;
    }
}

@media (max-width: 959px) {
    /* Stack Hero content and center it above the mascot. */
    .hero {
        min-height: 100svh;
    }

    .hero-container {
        min-height: 100svh;
        grid-template-columns: minmax(0, 1fr);
        gap: clamp(28px, 5vh, 44px);
        padding: 88px 16px 24px;
    }

    .hero-content {
        width: 100%;
        max-width: 680px;
        justify-self: center;
        text-align: center;
    }

    .hero-title {
        font-size: clamp(1.6rem, 6.6vw, 2.6rem);
        line-height: 1.06;
    }

    .hero-subcopy {
        margin: 16px auto 0;
    }

    .hero-content > .hero-actions {
        align-items: center;
        margin-top: 48px;
    }

    .mascot-stage {
        width: min(100%, 380px);
        max-width: 380px;
        justify-self: center;
    }

    .mascot-image {
        max-height: min(40svh, 340px);
    }
}

@media (max-width: 600px) {
    .hero-container {
        gap: clamp(24px, 4vh, 36px);
        padding: 80px 16px 16px;
    }

    .hero-title {
        font-size: clamp(1.25rem, 6.25vw, 2.2rem);
    }

    .hero-subcopy {
        max-width: 360px;
        font-size: 0.96rem;
    }

    .mascot-stage {
        width: min(100%, 340px);
    }

    .mascot-image {
        max-height: min(36svh, 280px);
    }
}

/* Core Features section styles */
.core-features {
    position: relative;
    min-height: 100svh;
    overflow: hidden;
    background: rgb(var(--v-theme-background));
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

.core-heading-accent {
    color: rgb(var(--v-theme-secondary));
}

.core-eyebrow {
    margin: 0 0 12px;
    color: rgb(var(--v-theme-primary));
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
    background: rgba(var(--v-theme-on-surface), 0.10);
}

.core-progress-fill {
    display: block;
    width: 100%;
    height: 100%;
    transform-origin: left center;
    background: linear-gradient(90deg, rgb(var(--v-theme-primary)), rgb(var(--v-theme-secondary)));
}

.core-steps {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

/* Active copy follows the same scroll progress as the matching visual scene. */
.core-step {
    position: relative;
    display: grid;
    grid-template-columns: 48px 1fr;
    gap: 10px;
    padding: 15px 16px;
    border: 1px solid rgba(var(--v-theme-on-surface), 0.055);
    border-radius: 16px;
    opacity: 0.42;
    color: rgb(var(--v-theme-subheading));
    background: rgba(var(--v-theme-surface), 0.28);
    transition: none
}

.core-step.is-active {
    opacity: 1;
    transform: translateX(6px);
    border-color: rgba(var(--v-theme-primary), 0.72);
    background: linear-gradient(90deg, rgba(var(--v-theme-primary), 0.16), rgba(var(--v-theme-surface), 0.82));
    box-shadow: inset 3px 0 0 rgb(var(--v-theme-secondary)), 0 12px 36px rgba(var(--v-theme-background), 0.28);
}

.core-step-number {
    color: rgb(var(--v-theme-primary));
    font-size: 0.82rem;
    font-weight: 900;
    letter-spacing: 0.12em;
}

.core-step.is-active .core-step-number {
    color: rgb(var(--v-theme-secondary));
}

.core-step h3,
.core-step p {
    margin: 0;
}

.core-step h3 {
    color: rgb(var(--v-theme-on-surface));
    font-size: 1.12rem;
    line-height: 1.25;
}

.core-step p {
    margin-top: 5px;
    max-width: 520px;
    color: color-mix(in srgb, rgb(var(--v-theme-on-surface)) 28%, rgb(var(--v-theme-subheading)));
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
        radial-gradient(circle, rgba(var(--v-theme-primary), 0.24) 0%, rgba(var(--v-theme-primary), 0.08) 42%, transparent 68%),
        radial-gradient(circle at 68% 68%, rgba(var(--v-theme-secondary), 0.10), transparent 42%);
    filter: blur(12px);
}

.core-mascot {
    position: relative;
    z-index: 1;
    width: min(100%, 520px);
    height: auto;
    max-height: min(540px, 66vh);
    object-fit: contain;
    filter: drop-shadow(0 28px 38px rgba(var(--v-theme-background), 0.38));
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

/* Inline illustrations belong to mobile cards; the shared stage is for desktop. */
.core-inline-visual {
    display: none;
}

@media (max-width: 959px) {
    .core-features {
        min-height: 0;
        padding-block: 72px;
    }

    .core-showcase {
        width: 100%;
        height: auto;
        min-height: 0;
        display: block;
        padding: 0 20px;
    }

    .core-copy {
        width: 100%;
    }

    .core-heading {
        margin-bottom: 36px;
    }

    .core-progress {
        display: none;
    }

    .core-steps {
        gap: 72px;
    }

    .core-step,
    .core-step.is-active {
        display: flex;
        flex-direction: column;
        align-items: stretch;
        gap: 0;
        min-width: 0;
        padding: 0;
        border: 0;
        border-radius: 0;
        opacity: 1;
        transform: none;
        color: rgb(var(--v-theme-on-surface));
        background: none;
        box-shadow: none;
        transition: none;
    }

    .core-step-number,
    .core-step.is-active .core-step-number {
        margin-bottom: 12px;
        color: rgb(var(--v-theme-secondary));
        font-size: 0.9rem;
    }

    .core-step h3 {
        font-size: clamp(1.35rem, 4vw, 1.65rem);
        line-height: 1.2;
    }

    .core-step p {
        max-width: 42rem;
        margin: 8px 0 0;
        color: color-mix(in srgb, rgb(var(--v-theme-on-surface)) 55%, rgb(var(--v-theme-subheading)));
    }

    .core-inline-visual {
        position: relative;
        display: grid;
        place-items: center;
        width: 100%;
        min-height: 0;
        margin-top: 24px;
        overflow: hidden;
    }

    .core-inline-visual .visual-glow {
        width: min(78%, 360px);
        background:
            radial-gradient(circle, rgba(var(--v-theme-primary), 0.28) 0%, rgba(var(--v-theme-primary), 0.10) 46%, transparent 72%);
    }

    .core-inline-visual .core-mascot {
        width: 75%;
        max-height: 40svh;
    }

    .features-stage {
        display: none;
    }
}

/* Cardless kinetic Extra Features showcase */
.extra-features {
    --kinetic-h: calc(clamp(4.1rem, min(10.66vw, 19.68svh), 10.66rem) + 4svh);
    position: relative;
    height: 100svh;
    min-height: 680px;
    overflow: hidden;
    background:
        radial-gradient(circle at 78% 48%, rgba(var(--v-theme-primary), 0.10), transparent 30%),
        rgb(var(--v-theme-background));
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
    color: rgb(var(--v-theme-secondary));
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
    bottom: 4svh;
    white-space: nowrap;
    font-size: clamp(5rem, min(13vw, 24svh), 13rem);
    line-height: 0.82;
    font-weight: 900;
    letter-spacing: -0.06em;
    color: rgba(var(--v-theme-on-surface), 0.035);
    -webkit-text-stroke: 1px rgba(var(--v-theme-primary), 0.10);
    pointer-events: none;
}

.extra-track {
    position: relative;
    z-index: 2;
    box-sizing: border-box;
    height: 100%;
    width: max-content;
    display: flex;
    align-items: flex-start;
    gap: clamp(70px, 7vw, 130px);
    padding:
        calc(112px + var(--extra-heading-height, 80px) + 80px)
        7vw
        calc(var(--kinetic-h) + 180px);
    will-change: transform;
}

/* Each station combines a benefit description with a simple animated drawing. */
.extra-station {
    position: relative;
    flex: 0 0 clamp(520px, 44vw, 660px);
    min-height: min(28svh, 460px);
    display: grid;
    grid-template-columns: clamp(110px, 9vw, 150px) minmax(0, 1fr);
    grid-template-rows: auto auto;
    align-items: flex-start;
    column-gap: clamp(28px, 3vw, 46px);
    row-gap: 0;
}

.extra-number {
    grid-column: 1;
    grid-row: 1;
    color: rgb(var(--v-theme-secondary));
    font-size: clamp(4.5rem, 7vw, 7.5rem);
    line-height: 0.78;
    font-weight: 950;
    letter-spacing: -0.08em;
}

.extra-copy {
    grid-column: 2;
    grid-row: 1;
    min-width: 0;
    max-width: min(100%, 420px);
    padding-top: 8px;
}

.extra-copy h3 {
    margin: 0 0 12px;
    color: rgb(var(--v-theme-on-surface));
    font-size: clamp(2rem, 3.2vw, 3.35rem);
    line-height: 1;
    letter-spacing: -0.035em;
}

.extra-copy p {
    max-width: 380px;
    margin: 0 0 18px;
    color: color-mix(in srgb, rgb(var(--v-theme-on-surface)) 55%, rgb(var(--v-theme-subheading)));
    font-size: 1.05rem;
    line-height: 1.55;
}

.extra-tag {
    display: inline-block;
    color: rgb(var(--v-theme-secondary));
    font-size: 0.82rem;
    font-weight: 900;
    letter-spacing: 0.09em;
    text-transform: uppercase;
    border-bottom: 2px solid rgba(var(--v-theme-secondary), 0.72);
    padding-bottom: 5px;
}

.extra-drawing {
    position: relative;
    grid-column: 2;
    grid-row: 2;
    justify-self: end;
    width: auto;
    max-width: min(100%, clamp(110px, 10vw, 148px));
    height: auto;
    max-height: clamp(110px, 13vh, 150px);
    margin-top: clamp(16px, 2.4svh, 28px);
    overflow: visible;
    filter: drop-shadow(0 12px 24px rgba(var(--v-theme-primary), 0.10));
}

@media (min-width: 960px) {
    .extra-station {
        padding-bottom: clamp(24px, 3svh, 36px);
    }

    .extra-copy h3 {
        font-size: clamp(1.75rem, 2.35vw, 2.75rem);
        white-space: nowrap;
    }

    .extra-drawing {
        margin-top: clamp(18px, 1.25vw, 24px);
    }
}

.extra-drawing .draw-path {
    stroke: rgb(var(--v-theme-primary));
    stroke-width: 5;
    stroke-linecap: round;
    stroke-linejoin: round;
}

.extra-drawing .draw-path.gold,
.extra-drawing .draw-bar.gold {
    stroke: rgb(var(--v-theme-secondary));
}

.extra-drawing .draw-path.indigo,
.extra-drawing .draw-dot.indigo {
    stroke: rgb(var(--v-theme-primary));
}

.extra-drawing .draw-dot {
    fill: rgb(var(--v-theme-secondary));
    stroke: rgb(var(--v-theme-secondary));
    stroke-width: 3;
}

.extra-drawing .draw-dot.indigo {
    fill: rgb(var(--v-theme-primary));
}

.extra-drawing .gauge-label {
    fill: rgb(var(--v-theme-on-surface));
    font-size: 24px;
    font-weight: 900;
    letter-spacing: 1px;
    text-anchor: middle;
}

.extra-drawing .draw-bar {
    stroke-width: 28;
    stroke-linecap: round;
}

/* Restore a readable grid when horizontal scrolling is disabled. */
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
        padding: 64px 20px;
    }

    .extra-features--fallback .extra-track {
        grid-template-columns: 1fr;
        gap: 68px;
        max-width: 680px;
        margin-inline: auto;
    }

    .extra-features--fallback .extra-station {
        display: grid;
        grid-template-columns: max-content minmax(0, 1fr);
        grid-template-rows: auto auto;
        align-items: start;
        column-gap: 12px;
        row-gap: 0;
        min-height: 0;
    }

    .extra-number {
        font-size: 4.25rem;
    }

    .extra-copy {
        padding-top: 0;
    }

    .extra-copy h3 {
        font-size: 2.1rem;
    }

    .extra-drawing {
        position: static;
        grid-column: 2;
        grid-row: 2;
        justify-self: center;
        width: min(100%, 270px);
        max-width: min(100%, clamp(110px, 10vw, 148px));
        height: auto;
        max-height: clamp(110px, 13vh, 150px);
        margin-top: 26px;
        opacity: 0.9;
    }
}

@media (max-width: 600px) {
    .extra-features--fallback {
        padding: 56px 20px;
    }

    .extra-features--fallback .extra-heading {
        margin-bottom: 24px;
    }

    .extra-features--fallback .extra-station {
        column-gap: 8px;
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

}

/* Final 12-column layout balances the signup copy and PR chart card. */
.final-progress-section {
    position: relative;
    min-height: 100svh;
    display: grid;
    align-items: center;
    overflow: hidden;
    background:
        radial-gradient(circle at 82% 48%, rgba(var(--v-theme-primary), 0.16), transparent 30%),
        rgb(var(--v-theme-background));
}

.final-progress-glow {
    position: absolute;
    width: 420px;
    height: 420px;
    right: 8%;
    top: 50%;
    transform: translateY(-50%);
    border-radius: 50%;
    background: radial-gradient(circle, rgba(var(--v-theme-primary), 0.18), transparent 70%);
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
    color: rgb(var(--v-theme-primary));
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

.final-title-accent {
    color: rgb(var(--v-theme-secondary));
}

.final-description {
    max-width: 590px;
    margin: 22px 0 28px;
    color: color-mix(in srgb, rgb(var(--v-theme-on-surface)) 55%, rgb(var(--v-theme-subheading)));
    line-height: 1.65;
}

/* Keep the three proof points aligned as one compact row. */
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
    color: rgb(var(--v-theme-on-surface));
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
    color: color-mix(in srgb, rgb(var(--v-theme-on-surface)) 55%, rgb(var(--v-theme-subheading)));
    font-size: 0.8rem;
    line-height: 1.3;
}

.final-reassurance {
    margin-top: 12px;
    color: rgba(var(--v-theme-subheading), 0.84);
    font-size: 0.84rem;
}

.record-showcase {
    grid-column: 7 / -1;
    min-width: 0;
}

/* The card combines the milestone details, mascot, and progress chart. */
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
    border: 1px solid rgba(var(--v-theme-primary), 0.22);
    border-top: 4px solid transparent;
    background:
        linear-gradient(145deg, rgba(var(--v-theme-surface-bright), 0.72), rgba(var(--v-theme-surface), 0.92)),
        rgb(var(--v-theme-surface));
    box-shadow: 0 26px 70px rgba(var(--v-theme-background), 0.48), 0 0 44px rgba(var(--v-theme-primary), 0.08);
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
        radial-gradient(circle, rgba(var(--v-theme-primary), 0.22), transparent 68%);
    filter: blur(14px);
    pointer-events: none;
}

.record-visual::after {
    content: '';
    position: absolute;
    z-index: 3;
    inset: 0 0 auto;
    height: 4px;
    background: linear-gradient(90deg, rgb(var(--v-theme-primary)), rgb(var(--v-theme-secondary)));
    pointer-events: none;
}

.record-visual-top {
    position: relative;
    z-index: 2;
    display: grid;
    grid-template-columns: minmax(0, 1fr) max-content;
    align-items: center;
    gap: 16px;
    color: color-mix(in srgb, rgb(var(--v-theme-on-surface)) 55%, rgb(var(--v-theme-subheading)));
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
    color: rgb(var(--v-theme-on-secondary));
    background: rgb(var(--v-theme-secondary));
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
    color: rgb(var(--v-theme-on-surface));
    font-size: 0.9rem;
    font-weight: 800;
    letter-spacing: 0.11em;
    text-transform: uppercase;
}

.record-score {
    display: flex;
    align-items: baseline;
    gap: 10px;
    color: rgb(var(--v-theme-on-surface));
}

.record-score strong {
    color: rgb(var(--v-theme-secondary));
    font-size: clamp(4.5rem, 6.6vw, 6.75rem);
    line-height: 0.88;
    white-space: nowrap;
}

.record-score span {
    color: rgb(var(--v-theme-subheading));
    font-size: 1.5rem;
}

.record-delta {
    margin: 10px 0 0;
    color: color-mix(in srgb, rgb(var(--v-theme-on-surface)) 55%, rgb(var(--v-theme-subheading)));
    font-size: 0.92rem;
    font-weight: 700;
}

.record-milestone {
    margin: 7px 0 0;
    color: rgba(var(--v-theme-subheading), 0.72);
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
    background: rgb(var(--v-theme-primary));
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
        drop-shadow(0 18px 30px rgba(var(--v-theme-primary), 0.26));
}

.record-chart {
    position: relative;
    width: 100%;
    aspect-ratio: 480 / 220;
    margin-top: auto;
}

.record-line {
    position: absolute;
    inset: 0;
    display: block;
    width: 100%;
    height: 100%;
    overflow: visible;
}

.record-grid {
    stroke: rgba(var(--v-theme-on-surface), 0.08);
    stroke-width: 1.5;
}

.record-axis-ticks {
    stroke: rgba(var(--v-theme-on-surface), 0.2);
    stroke-width: 1.5;
    stroke-linecap: round;
}

.record-area {
    fill: url(#record-area-gradient);
}

.record-progress-line {
    stroke: rgb(var(--v-theme-primary));
    stroke-width: 5;
    stroke-linecap: round;
    stroke-linejoin: round;
}

.record-data-point {
    fill: rgb(var(--v-theme-primary));
    stroke: rgb(var(--v-theme-surface));
    stroke-width: 2;
}

.record-callout-leader {
    stroke: rgba(var(--v-theme-primary), 0.72);
    stroke-width: 1.5;
}

.record-point {
    fill: rgb(var(--v-theme-secondary));
    stroke: rgb(var(--v-theme-surface));
    stroke-width: 4;
}

.record-callout-badge {
    position: absolute;
    z-index: 1;
    top: 4px;
    right: 14%;
    padding: 6px 9px;
    border: 1px solid rgba(var(--v-theme-primary), 0.55);
    border-radius: 8px;
    background: rgb(var(--v-theme-surface-bright));
    color: rgb(var(--v-theme-secondary));
    font-size: clamp(11px, 0.75vw, 13px);
    font-weight: 800;
    line-height: 1;
    white-space: nowrap;
    pointer-events: none;
}

.record-month {
    fill: rgba(var(--v-theme-subheading), 0.72);
    font-family: inherit;
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 0.04em;
}

@media (max-width: 1199px) {
    /* Stack copy above the chart as the desktop grid runs out of room. */
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

@media (max-width: 959px) {
    .record-highlights {
        justify-items: center;
    }

    .record-highlight {
        align-items: center;
        text-align: center;
    }

    .record-highlight:nth-child(2) strong {
        transform-origin: center;
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

}

@media (prefers-reduced-motion: reduce) {
    .primary-cta {
        transition: none;
    }

    .primary-cta:hover {
        transform: none;
    }
}
</style>