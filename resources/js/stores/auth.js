import { ref } from 'vue'
import axios from 'axios'

const user = ref(null)

const fetchUser = async () => {
    try {
        const response = await axios.get('/api/user')
        user.value = response.data
    } catch {
        user.value = null
    }
}

export { user, fetchUser }