'use strict'

const header = document.querySelector('header');
const top = document.querySelector('.topPage');
const product = document.querySelector('.productPage');
const productDetail = document.querySelector('.productDetailPage');
const cart = document.querySelector('.cartPage');
const login = document.querySelector('.loginPage');
const account = document.querySelector('.accountPage');
const register = document.querySelector('.registerPage');
const registerComfirm = document.querySelector('.comfirmPage');
const registerComplete = document.querySelector('.completePage');
const linkString = [
                        '.topPage',
                        '.productPage',
                        '.productDetailPage'
                        
                    ]

window.addEventListener('load', function () {
    const productTitle = document.querySelector('.detailTitle');
    const productName = productTitle?.textContent.trim() ?? '';

    const pageClassAll = [
                        top,
                        product,
                        productDetail,
                        cart,
                        login,
                        account,
                        register,
                        registerComfirm,
                        registerComplete
                    ];

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

    accountPage: [
        {text: 'TOP', href: './index.php'},
        {text: 'アカウント', href: null}
    ],

    registerPage: [
        {text: 'TOP', href: './index.php'},
        {text: '会員登録', href: null}
    ],

    registerComfirmPage: [
        {text: 'TOP', href: './index.php'},
        {text: '会員登録', href: './register.php'},
        {text: '会員登録確認', href: null}
    ],

    registerComplete: [
        {text: 'TOP', href: './index.php'},
        {text: '会員登録完了', href: null}
    ]
};
    const linkContainer = document.createElement('div');
    header.after(linkContainer);
    linkContainer.classList.add('breadcrumb')
    pageClassAll.forEach(function (item, index) {
    if() {
        let breadcrumb = breadcrumbPatterns
    }       
    })
})
