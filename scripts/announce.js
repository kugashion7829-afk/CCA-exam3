'use strict'

const announce = document.querySelector('.announce');
const linkAll = [
                        '.topPage',
                        '.productPage',
                        '.productDetailPage',
                        '.cartPage',
                        '.loginPage',
                        '.loginCompletePage',
                        '.accountPage',
                        '.registerPage',
                        '.comfirmPage',
                        '.completePage'
                    ];

const linkString = [
                        'topPage',
                        'productPage',
                        'productDetailPage',
                        'cartPage',
                        'loginPage',
                        'loginCompletePage',
                        'accountPage',
                        'registerPage',
                        'comfirmPage',
                        'completePage'
                    ];

window.addEventListener('load', function () {
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
            {text: 'ログイン完了', hraf: null}
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
            {text: '入力確認', href: './register.php'},
            {text: '入力確認', href: null}
        ],

        completePage: [
            {text: 'TOP', href: './index.php'},
            {text: '会員登録完了', href: null}
        ]
    };
    
    const linkContainer = document.createElement('div');
    announce.before(linkContainer);
    linkContainer.classList.add('breadcrumb')
    if (document.querySelector('.topPage')) {
    linkContainer.style.display = 'none';
    }
    let breadcrumb = [];
    linkAll.forEach(function (item, index) {

    if(document.querySelector(item)) {
            breadcrumb = breadcrumbPatterns[linkString[index]];
            breadcrumb.forEach(function (item, index) {
                if (index > 0) {
                    const separator = document.createElement('span');
                    separator.textContent = '＞';
                    linkContainer.appendChild(separator);
                }

                const element = document.createElement(
                    item.href === null ? 'span' : 'a'
                );

                element.textContent = item.text;

                if (item.href !== null) {
                    element.href = item.href;
                } else {
                    element.setAttribute('aria-current', 'page');
                }

                linkContainer.appendChild(element);
            });
        }          
    })
})
