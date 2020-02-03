const puppeteer = require('puppeteer');

(async () => {
    const browser = await puppeteer.launch();
    const page = await browser.newPage();
    await page.goto('https://example.com');
    const result = await page.$('body > div > h1');

    await result.screenshot({path: 'example.png'});

    await browser.close();
})();