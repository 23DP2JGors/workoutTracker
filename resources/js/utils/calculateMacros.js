// Calculates daily calories and macros from user profile data
export function calculateMacros(profile) {
    // Return nothing if required profile fields are missing
    if (
        !profile?.weight ||
        !profile?.height ||
        !profile?.age ||
        !profile?.activity_level ||
        !profile?.gender
    ) {
        return null
    }

    // Convert values from strings to numbers if they come from the API
    const weight = Number(profile.weight)
    const height = Number(profile.height)
    const age = Number(profile.age)
    const activityLevel = Number(profile.activity_level)

    // Calculate BMR using the Mifflin-St Jeor formula
    let bmr = (10 * weight) + (6.25 * height) - (5 * age)
    bmr = profile.gender === 'male' ? bmr + 5 : bmr - 161

    // Calculate maintenance calories based on activity level
    let tdee = Math.round(bmr * activityLevel)

    // Adjust calories based on the user's goal
    if (profile.goal === 'loss') {
        tdee = Math.round(tdee * 0.85)
    }

    if (profile.goal === 'gain') {
        tdee = Math.round(tdee * 1.15)
    }

    // Calculate protein target using 1.8g per kg of body weight
    const protein = Math.round(weight * 1.8)

    // Use different fat coefficient depending on goal and gender
    let fatCoeff

    if (profile.goal === 'loss') {
        fatCoeff = profile.gender === 'male' ? 0.5 : 0.8
    } else {
        fatCoeff = profile.gender === 'male' ? 0.8 : 1.0
    }

    const fats = Math.round(weight * fatCoeff)

    // Calculate carbs from the remaining calories
    const proteinKcal = protein * 4
    const fatsKcal = fats * 9
    const carbs = Math.round((tdee - proteinKcal - fatsKcal) / 4)

    return {
        calories: tdee,
        protein,
        fats,
        carbs,
    }
}