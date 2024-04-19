jQuery(document).ready(function () {
	jQuery('.eap-add-faq-button').on('click', function (event) {
		var Post_ID = jQuery('#eap-post-id').val();

		var FAQs = [];
		jQuery('.eap-add-faq').each(function () {
			if (jQuery(this).is(':checked')) {
				FAQs.push(jQuery(this).val());
			}
			jQuery(this).prop('checked', false);
		});

		var data = 'FAQs=' + JSON.stringify(FAQs) + '&Post_ID=' + Post_ID + '&action=eap_add_wc_faqs';
		jQuery.post(ajaxurl, data, function (response) {
			var Add_FAQs = jQuery.parseJSON(response);
			jQuery(Add_FAQs).each(function (index, el) {
				var HTML = "<p class='eap-faq-row eap-delete-faq-row' data-faqid='" + el.ID + "'>";
				HTML += "<input type='checkbox' class='eap-delete-faq' name='Delete_FAQs[]' value='" + el.ID + "'/>";
				HTML += el.Name;
				HTML += "</p>";
				jQuery('.eap-delete-table p:last').after(HTML);
			});
		});

		event.preventDefault();
	})
});

jQuery(document).ready(function () {
	jQuery('.eap-delete-faq-button').on('click', function (event) {
		var Post_ID = jQuery('#eap-post-id').val();

		var FAQs = [];
		jQuery('.eap-delete-faq').each(function () {
			if (jQuery(this).is(':checked')) {
				FAQs.push(jQuery(this).val());
			}
			jQuery(this).prop('checked', false);
		});

		var data = 'FAQs=' + JSON.stringify(FAQs) + '&Post_ID=' + Post_ID + '&action=eap_delete_wc_faqs';
		jQuery.post(ajaxurl, data, function (response) {});

		jQuery(FAQs).each(function (index, el) {
			jQuery(".eap-delete-faq-row[data-faqid='" + el + "']").fadeOut('500', function () {
				jQuery(this).remove();
			});
		});

		event.preventDefault();
	})
});