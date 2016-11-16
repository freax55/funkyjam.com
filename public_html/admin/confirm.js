function confirmDownloadTicketOrder() {
	var ret = confirm('前回ダウンロードしてから現時点までのチケット売上データをダウンロードしますか？' + "\n"
		+ '同じ売上データは一度しかダウンロードできませんのでご注意ください。' + "\n"
		+ '誤ってダウンロードしてしまった場合は、ダウンロードを行った日時をご連絡ください。');
		
	if (ret) {
		location.href = 'order/kubota_ticket.php';
	}
}

