function confirmDownloadTicketOrder() {
	var ret = confirm('�����������ɤ��Ƥ��鸽�����ޤǤΥ����å����ǡ������������ɤ��ޤ�����' + "\n"
		+ 'Ʊ�����ǡ����ϰ��٤�����������ɤǤ��ޤ���ΤǤ���դ���������' + "\n"
		+ '��äƥ�������ɤ��Ƥ��ޤä����ϡ���������ɤ�Ԥä�������Ϣ����������');
		
	if (ret) {
		location.href = 'order/kubota_ticket.php';
	}
}

