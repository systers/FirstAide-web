describe('validateNumber', function() {
    it('Should be phone number', function() {
        expect(validation.isPhoneNumber('342345235')).toBeTruthy();
    });

    it('Should not be phone number', function() {
        expect(validation.isPhoneNumber('324fdgfd215235')).not.toBeTruthy();
    });
});

describe('validateEmail', function() {
    it('Should be email', function() {
        expect(validation.isEmailAddress('abc@def.com')).toBeTruthy();
    });

	it('Should be email', function() {
        expect(validation.isEmailAddress('mail.google.com')).not.toBeTruthy();
    });
});