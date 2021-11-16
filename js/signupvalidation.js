// jQuery validation for sign up

$.validator.addMethod("alphabet", function (value, element) {
	return this.optional(element) || (/^[A-Z][a-z]{1,}$/).test(value);
}, "Must contain only letters, capitalise only first letter and lowercase the rest. Do not include any spaces.");

$.validator.addMethod("number", function (value, element) {
	return this.optional(element) || (/^(0)[0-9]{10}$/).test(value);
}, "Must start with 0 and contain 11 digits.");

$.validator.addMethod("email", function (value, element) {
	return this.optional(element) || (/^[0-9]+@aston\.ac\.uk$/).test(value);
}, "Must contain your 9 digit ID with @aston.ac.uk ending.");

$.validator.addMethod("password", function (value, element) {
	return this.optional(element) || (/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[~`!£$%*@~#+=,;?]).{8,}$/).test(value);
}, "Must contain at least 8 characters, including at least one uppercase letter, one lowercase letter, one number and special character such as ~`!£$%*@~#+=,;?");

$(function () {
	$("#signupform").validate({
		rules: {
			name: {
				required: true,
				alphabet: true,
				maxlength: 64
			},
			surname: {
				required: true,
				alphabet: true,
				maxlength: 64
			},
			number: {
				required: true,
				number: true
			},
			email: {
				required: true,
				email: true,
				minlength: 21,
				maxlength: 21
			},
			password: {
				required: true,
				password: true
			},
			confirmpassword: {
				required: true,
				equalTo: "#password"
			}
		},
		messages: {
			name: {
				required: "Please enter your first name.",
				maxlength: "Please enter no more than 64 letters."
			},
			surname: {
				required: "Please enter your surname.",
				maxlength: "Please enter no more than 64 letters."
			},
			number: {
				required: "Please enter your UK phone number."
			},
			email: {
				required: "Please enter your aston email address.",
				minlength: "Please type your 9 digit id with @aston.ac.uk ending.",
				maxlength: "Please type your 9 digit id with @aston.ac.uk ending."
			},
			password: {
				required: "Please enter your password."
			},
			confirmpassword: {
				required: "Please confirm your password.",
				equalTo: "Your password does not match, please type again."
			}
		}
	});
});
