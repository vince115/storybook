# 圓夢繪本資料庫 (Storybook)

以主題地圖與 D3 視覺化瀏覽繪本的靜態網站（HTML / CSS3 / jQuery / D3 v3）。

原始碼遺失，本 repo 是從線上部署版本還原：
<https://storage.googleapis.com/aaixd/storybook/index/index.html>

## 結構

| 路徑 | 說明 |
|---|---|
| `index/` | 首頁（CSS3 星空、行星動畫，三個入口） |
| `map/` | 主題地圖（食物、動物園、交通、太空…），SVG 平移縮放 |
| `d3/books/` | 各分類繪本清單（D3 v3），資料在 `js/data_*.js` |
| `d3/coffeewheel/` | 分類輪盤 |
| `img/books/ss/` | 繪本封面縮圖 |
| `map/demo_book.php` | 舊版 PHP + MySQL 查詢頁（已停用） |

## 本機執行

```bash
python3 -m http.server 8123
```

開啟 <http://localhost:8123/index/index.html>

## 還原狀況

伺服器上已不存在、無法取回的檔案：

- `d3/tree/index.html`：首頁第二個入口（樹狀圖）
- `d3/coffeewheel/js/index6.js`：輪盤主程式，所以輪盤頁目前不會動
- `img/books/183/183_P01.jpg`
- `map/db.inc.php`

從站內其他位置或 CDN 補回的第三方檔案：

- Font Awesome 4.2.0 字型（`fonts/`）
- `d3/coffeewheel/` 的 `css/`、`js/d3.min.js`、`js/jquery.min.js`、`js/jquery.svg.pan.zoom.js`、`js/mapbtn.js`（複製自 `d3/books/` 與 `map/`）
- `d3/books/js/jquery.svg.pan.zoom.js`（複製自 `map/js/`）

`map/demo_book.php` 原本寫死了資料庫帳密，現在改成讀 `DB_USER` / `DB_PASS` 環境變數。
