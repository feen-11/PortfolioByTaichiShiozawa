# PortfolioByTaichiShiozawa
お世話になっております。塩澤泰知と申します。今回はポートフォリオをご覧頂きありがとうございます。
こちらはポートフォリオとして公開している「YourFitness」のソースコードです。  

## 「YourFitness」  
今回開発した「YourFitness」は、毎日の食事やトレーニングを記録し**利用者のフィットネスライフを手助けするアプリケーション**です。また日記機能も実装しているので、その日のトレーニングや食事の反省点、良かった点などを書き出して今後に活用して頂けば幸いです。もちろんフィットネスに無関係な「こんな事があった！」といったようなことを日記にするなど自由に利用して頂けばと思います。

## 開発に至った経緯
私自身の趣味として日頃取り組んでいる筋トレにおいて、せっかくトレーニングを頑張ったのに太るような食事をしてしまい、いまいち体に変化を感じない事が課題でした。トレーニング自体は毎日決めたメニューをこなしていたのですが、食事の内容は好きな物を適当に食べていたのでそこを改善する事が重要ではないかと考えました。そこで成果を出すような食事とトレーニングを手助けするようなアプリケーションがあれば良いと考え、開発に着手しました。  

## こだわったポイント  
　自分と同じく食事の管理が上手くいかずダイエットの成果がいまいち出ないと悩む人は多くいると思うので、基礎代謝やBMIなど現時点の自分を把握してこれからどうしていけば良いか考えながら使ってもらえるように始めの目標設定時に意気込みと具体的目標体重を決めて頂く仕様にしました。モチベーションが下がった時は「なんでわざわざこんな大変なことをしているのだろう」という考えに陥る事があると思うので、そういった時に最初の意気込みを見て頑張って欲しいなと思います。何事も**楽しく続ける事が一番です！**  

## 苦労したところ
　アプリケーションを一から作り、完成させる工程はこんなにも大変なのかと実感致しました。今まで勉強用の仮想環境のみでの開発をしてきましたが、本番環境に合わせてプログラムを改変することや設定を調整する作業は非常に苦労しました。また、「こんな機能があったらもっと良くなるぞ！」とアイディアが浮かんでも、スキル不足が故に実装に至らないことも多くありました。開発全体を通して感じたことは、一つ壁を超えたらまたもう一つ大きな壁が現れるような感覚でした。仮想環境で「ついに出来た！」と思いデプロイ作業に意気揚々と着手したもののバグだらけ、このようなことの連続でした。しかし今まで独学で勉強を進めてきた事でこういった事には多少の慣れがあったので完成まで持っていく事が出来たと思います。今後も勉強を進めていく中で、プログラミングの全てを学ぶことは中々出来ることではないと思うので、この精神的成長は大きいなと感じています。


## ディレクトリ構造目次  

**config**  
- config.php(定数管理や細かな設定ファイル)  
- init.sql (データベース構造)  
       
**lib**    
- Controller(コントローラー)  
- Model(モデル)  
- Exception(例外処理)  
       
**public_html**  
- images(画像ファイル)  
- ○○○.php(ビュー：各ページのhtmlファイル)  
- styles.css(スタイリング)  

## バックエンド要素
・PHPによる動的webサイトの作成  
・PHPとデータベースを用いたCRUD処理   
・MVCモデルを用いたプログラム設計  
・例外処理  
・CSRF対策  
・仮想環境を用いたローカル開発  
・herokuを用いたデプロイ及び公開  

## フロントエンド要素  
・レスポンシブ対応のサイト構築  
・Bootstrapを用いた開発  




## 使用した言語   
PHP 7.3.11  
MySQL Ver 14.14  
Bootstrap 4.5.2   
HTML CSS  
JavaScript  

