jQuery.validator.setDefaults({
	    highlight: function(element) {
	        $(element).closest('.form-group').addClass('has-error').removeClass('has-success');
	        $(element).closest('.form-group').find('.form-control-feedback').addClass('glyphicon-remove').removeClass('glyphicon-ok');
			$('#submit').addClass('disabled');
	    },

	    unhighlight: function(element) {
	        $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
	        $(element).closest('.form-group').find('.form-control-feedback').addClass('glyphicon-ok').removeClass('glyphicon-remove');
			$('#submit').removeClass('disabled');
	    },

	    errorElement: 'span',

	    errorClass: 'help-block',

	    errorPlacement: function(error, element) {
	        if(element.parent('.input-group').length) {
	            error.insertAfter(element.parent());
	        } else {
	            error.insertAfter(element);
	        }
	    }

	});

	jQuery.extend(jQuery.validator.messages, {
	  required: "Ce champ est requis",
	  remote: "Une erreur est présente",
	  email: "Merci de renseigner un email valide",
	  url: "Merci de renseigner une URL valide (commence par http:// ou https://)",
	  date: "Merci de saisir une date",
	  dateISO: "Une erreur de date est présente",
	  number: "Hé, faut rentrer un numéro ici !",
	  digits: "Hé, faut rentrer un numéro ici !",
	  creditcard: "Une erreur est présente",
	  equalTo: "Les deux valeurs doivent être identiques",
	  accept: "Une erreur est présente",
	  maxlength: jQuery.validator.format("Doit contenir moins de {0} caractères."),
	  minlength: jQuery.validator.format("Doit contenir au-moins {0} caractères."),
	  rangelength: jQuery.validator.format("Doit contenir entre {0} et {1} caractères."),
	  range: jQuery.validator.format("Doit être entre {0} et {1}."),
	  max: jQuery.validator.format("Doit être inférieur ou égal à {0}."),
	  min: jQuery.validator.format("Doit être supérieur ou égal à {0}.")
	});