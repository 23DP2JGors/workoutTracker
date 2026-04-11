// Define validation rules for form fields
export const rules = {
    required: v => !!v || 'Field is required',
    email: v => /.+@.+\..+/.test(v) || 'Email is not correct',
    minLength: v => v.length >= 8 || 'at least 8 characters',
    hasUpper: v => /[A-Z]/.test(v) || 'Include an uppercase letter',
    hasLower: v => /[a-z]/.test(v) || 'Include an lowercase letter',
    hasSymbol: v => /[^a-zA-Z0-9]/.test(v) || 'Include special character',
    agree: v => !!v || 'You must agree to continue!'
};

