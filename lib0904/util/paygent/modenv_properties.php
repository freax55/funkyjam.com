<?php
###クライアント証明書ファイルパス###
paygentB2Bmodule.client_file_path=/home/funkyjam/lib0904/util/paygent/15869-20150512.pem

###認証済みのCAファイルパス###
paygentB2Bmodule.ca_file_path=/home/funkyjam/lib0904/util/paygent/curl-ca-bundle.crt

###プロキシサーバー設定（プロキシサーバーを使用する場合のみ設定）###
paygentB2Bmodule.proxy_server_name=
paygentB2Bmodule.proxy_server_ip=
paygentB2Bmodule.proxy_server_port=0

###接続ID、接続パスワードが設定されない場合に使用されるデフォルト値（空白可）###
paygentB2Bmodule.default_id=
paygentB2Bmodule.default_password=

###タイムアウト値（秒）###
paygentB2Bmodule.timeout_value=35

###ログファイル出力パス###
paygentB2Bmodule.log_output_path=/var/log/paygent/connectmodule.log


#!!!以下の値は編集しないでください!!!

###最大照会件数（2000件がペイジェントシステムの最大値なのでそれ以上の値は無効）###
paygentB2Bmodule.select_max_cnt=2000

###CSV出力対象###
paygentB2Bmodule.telegram_kind.ref=027,090
###ATM決済URL###
paygentB2Bmodule.url.01=https://module.paygent.co.jp/n/atm/request
###クレジットカード決済URL1###
paygentB2Bmodule.url.02=https://module.paygent.co.jp/n/card/request
###クレジットカード決済URL2###
paygentB2Bmodule.url.11=https://module.paygent.co.jp/n/card/request
###コンビニ番号方式決済URL###
paygentB2Bmodule.url.03=https://module.paygent.co.jp/n/conveni/request
###コンビニ帳票方式決済URL###
paygentB2Bmodule.url.04=https://module.paygent.co.jp/n/conveni/request_print
###銀行ネット決済URL###
paygentB2Bmodule.url.05=https://module.paygent.co.jp/n/bank/request
###銀行ネット決済ASPURL###
paygentB2Bmodule.url.06=https://module.paygent.co.jp/n/bank/requestasp
###仮想口座決済URL###
paygentB2Bmodule.url.07=https://module.paygent.co.jp/n/virtualaccount/request
###決済情報照会URL###
paygentB2Bmodule.url.09=https://module.paygent.co.jp/n/ref/request
###決済情報差分照会URL###
paygentB2Bmodule.url.091=https://module.paygent.co.jp/n/ref/paynotice
###携帯キャリア決済URL###
paygentB2Bmodule.url.10=https://module.paygent.co.jp/n/c/request
###ファイル決済URL###
paygentB2Bmodule.url.20=https://online.paygent.co.jp/n/o/requestdata
?>