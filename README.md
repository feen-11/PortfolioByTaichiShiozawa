![FireShot Capture 011 - 99252063-c22b1f00-2851-11eb-89a1-cce8fc7bffa4 png (2860×986)_ - user-images githubusercontent com](https://user-images.githubusercontent.com/61722629/99252472-5c8b6280-2852-11eb-8e87-9a25ff503ef3.png)
お世話になっております。塩澤泰知と申します。今回はポートフォリオをご覧頂きありがとうございます。
こちらはポートフォリオとして公開している「YourFitness」のソースコードです。  

# App URL
[YourFitness](yourfitness.herokuapp.com/index.php)

## 目次
- [「YourFitness」について](#yourfitness)
- [機能一覧](#機能一覧)
- [使用した技術](#使用した技術)
- [リポジトリのディレクトリ構造](#ディレクトリ構造目次)  
- [バックエンド要素](#バックエンド要素)
- [フロントエンド要素](#フロントエンド要素) 
- [今後追加したい機能](#今後追加したい機能)
- [開発に至った経緯](#開発に至った経緯)
- [こだわったポイント](#こだわったポイント)  
- [苦労したところ](#苦労したところ)  
- [開発を通しての成長](#開発を通しての成長)  


## 「YourFitness」  
今回開発した「YourFitness」は、毎日の食事やトレーニングを記録し**利用者のフィットネスライフを手助けするアプリケーション**です。また日記機能も実装しているので、その日のトレーニングや食事の反省点、良かった点などを書き出して今後に活用して頂けば幸いです。もちろんフィットネスに無関係な「こんな事があった！」といったようなことを日記にするなど自由に利用して頂けばと思います。

## 機能一覧
・記事投稿  
・記事閲覧  
・ユーザー登録  
・ユーザーログイン    
・摂取・消費カロリー等の計算  
・ユーザー情報に合わせたフィットネスへのアドバイス機能

## 使用した技術   
**言語**  
PHP 7.3.11  
JavaScript  
HTML,CSS　

**DB**  
MySQL Ver 14.14  

**フレームワーク**  
Bootstrap 4.5.2   

**インフラ**  
Heroku

## ディレクトリ構造目次  

**-config**  
- config.php(定数管理や細かな設定ファイル)  
- init.sql (データベース設定)  
       
**-lib**    
- Controller(コントローラー)  
- Model(モデル)  
- Exception(例外処理)  
       
**-public_html**  
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

## 今後追加したい機能
　一応アプリケーションとして形にする事が出来た「YourFitness」ですが今後も機能を追加してさらに良いものにしていきたいと考えています。**より多くのアイディアを得るために現在は友人にも使ってもらってフィードバックを受けたり、自分でも色々なアプリケーションを使ってみたりと視野を広げている段階です。**
 
 1.投稿を複数同時に出来るようにする  
 2.基礎代謝や摂取カロリー、消費カロリーのバランスからアドバイスを送る機能（現在よりも細かいアドバイス）  
 3.体重推移のグラフ参照でより見やすくする  
 4.カレンダーから過去の記録に飛べる機能  
 5.トレーニングメニュー生成機能 
 6.他ユーザーの投稿表示及びメッセージ機能

## 開発に至った経緯
私自身の趣味として日頃取り組んでいる筋トレにおいて、せっかくトレーニングを頑張ったのに太るような食事をしてしまい、いまいち体に変化を感じない事が課題でした。トレーニング自体は毎日決めたメニューをこなしていたのですが、食事の内容は好きな物を適当に食べていたので、そこを改善する事が**課題解決に繋がる**のではないかと考えました。そこで成果を出すような食事とトレーニングを手助けするようなアプリケーションがあれば良いと考え、開発に着手しました。  

## こだわったポイント  
　自分と同じく食事の管理が上手くいかずダイエットの成果がいまいち出ないと悩む人は多くいると思います。基礎代謝やBMIなど現時点の自分を把握してこれからどうしていけば良いか考えながら使ってもらえるように始めの目標設定時に意気込みと具体的目標体重を決めて頂く仕様にしました。モチベーションが下がった時は「なんでわざわざこんな大変なことをしているのだろう」という考えに陥る事があると思うので、そういった時に最初の意気込みを見て**モチベーション維持**に役立てて頂けたら嬉しいなと思います。**何事も楽しく続ける事が一番です！**  

## 苦労したところ
　**アプリケーションを一から作り、完成させる工程はこんなにも大変なのか**と実感致しました。今まで勉強用の仮想環境のみでの開発をしてきましたが、本番環境に合わせてプログラムを改変することや設定を調整する作業は非常に苦労しました。また、「こんな機能があったらもっと良くなるぞ！」とアイディアが浮かんでも、スキル不足が故に実装に至らないことも多くありました。開発全体を通して感じたことは、**一つ壁を超えたらまたもう一つ大きな壁が現れる**ような感覚でした。仮想環境で「ついに出来た！」と思いデプロイ作業に意気揚々と着手したもののバグだらけ、このようなことの連続でした。
 
## 開発を通しての成長
**苦労したところ**で述べたように多くの試練に直面しましたが、その分多くの学びと成長がありました。今まで独学で勉強を進めてきた事でこういった事には多少の慣れがあったので完成まで持っていく事が出来たと思います。行き詰まった時には「**一年間自分なりに続けてこれたのだから今回も大丈夫、乗り越えられる**」と信じ、ひたすら手を動かしました。今後も勉強を進めていく中でこの精神的成長は自分を支えてくれるだろうと感じています。また、理解が甘いところが多く露呈したので、勉強し直す良いきっかけを多く得ました。勉強⇨開発ではなく、**開発⇨足りない所を勉強**の流れの方が効率よく、理解も深い勉強になると感じました。
