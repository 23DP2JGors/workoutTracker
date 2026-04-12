<template>
    <div class="hero">
        <div class="logo">WorkoutTracker</div>
        <v-container class="pt-16">
            <v-row>
                <v-col cols="5">
                    
                </v-col>

                <v-col cols="7">
                    <p class="text-display-large font-weight-black">Track Every Rep.</p>
                    <p class="text-display-large font-weight-black">Crush Every Goal.</p>
                    <p class="text-display-large font-weight-black">Build Your Legacy.</p>

                    <div class="d-flex justify-center mt-10 pl-16">
                        <router-link to="/register" class="mr-5">
                            <v-btn>
                                Sign in
                            </v-btn>
                        </router-link>

                        <router-link to="/login">
                            <v-btn>
                                Login
                            </v-btn>
                        </router-link>
                    </div>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script>

</script>

<style scoped>

.logo {
    position: absolute;
    top: 24px;
    left: 32px;
    font-size: 1.5rem;
    font-weight: 700;
    
}

.hero {
    position: relative;
    height: 100vh;
    background-image: 
        linear-gradient(
            to bottom,
            rgba(0,0,0,0.3) 0%,
            rgba(18,18,18,1) 70%
        ),
        url('/images/bg_landing.jpg');
    background-size: cover;
    background-position: center;
}

</style>