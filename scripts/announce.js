'use strict'

const announce = document.querySelector('.announce');

document.addEventListener('DOMContentLoaded', function () {
    const productTitle = document.querySelector('.detailTitle');
    const productName = productTitle?.textContent.trim() ?? '';

    const breadcrumbPatterns = {
        topPage: [
            {text: 'TOP', href: null}
        ],

        productPage: [
            {text: 'TOP', href: './index.php'},
            {text: '商品一覧', href: null}
        ],

        productDetailPage: [
            {text: 'TOP', href: './index.php'},
            {text: '商品一覧', href: './product.php'},
            {text: productName, href: null}
        ],

        cartPage: [
            {text: 'TOP', href: './index.php'},
            {text: 'カート', href: null}
        ],

        loginPage: [
            {text: 'TOP', href: './index.php'},
            {text: 'ログイン', href: null}
        ],

        loginCompletePage: [
            {text: 'TOP', href: './index.php'},
            {text: 'ログイン完了', href: null}
        ],

        accountPage: [
            {text: 'TOP', href: './index.php'},
            {text: 'アカウント', href: null}
        ],

        registerPage: [
            {text: 'TOP', href: './index.php'},
            {text: '会員登録', href: null}
        ],

        comfirmPage: [
            {text: 'TOP', href: './index.php'},
            {text: '会員登録', href: './register.php'},
            {text: '入力確認', href: null}
        ],

        completePage: [
            {text: 'TOP', href: './index.php'},
            {text: '会員登録完了', href: null}
        ]
    };
    
    if (!announce || document.querySelector('.topPage')) return;

    const pageKey = Object.keys(breadcrumbPatterns).find(function (key) {
        return document.querySelector('.' + key);
    });
    if (!pageKey) return;

    const linkContainer = document.createElement('nav');
    linkContainer.classList.add('breadcrumb');
    linkContainer.setAttribute('aria-label', 'パンくず');
    breadcrumbPatterns[pageKey].forEach(function (item, index) {
        if (index > 0) {
            const separator = document.createElement('span');
            separator.textContent = '＞';
            separator.setAttribute('aria-hidden', 'true');
            linkContainer.appendChild(separator);
        }
        const element = document.createElement(item.href === null ? 'span' : 'a');
        element.textContent = item.text;
        if (item.href !== null) element.href = item.href;
        else element.setAttribute('aria-current', 'page');
        linkContainer.appendChild(element);
    });
    announce.before(linkContainer);
});
