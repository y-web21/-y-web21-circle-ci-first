<h1>{{ config('app.name') . ' - ' }}メール認証</h1>
<p>以下のURLにアクセスしていただくと登録が完了となります。</p>

<a href="{{ $url }}">{{ $url }}</a>

<p>※ このメールに見覚えのない場合はお手数ですが破棄してください。</p>
<p>© 21xx Fictitious companany</p>
