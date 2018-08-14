class ErrorHandler {
    static displayErrors(errors) {
        let actualErrors = errors.responseJSON.errors;
        for (var k in actualErrors) {
            console.log("Errory")
            ErrorHandler.errorForElement(k, actualErrors[k]);
        }
    }

    static errorForElement(element, error) {
        console.log("Emit")
        Event.vue.$emit('errorMessages', error);
    }
}

export default ErrorHandler;