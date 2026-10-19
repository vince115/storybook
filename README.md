# 圓夢繪本資料庫 (Storybook)

碩士論文《兒童數位圖書館資訊視覺化網站設計─以圓夢繪本資料庫為例》的研究原型網站（HTML / CSS3 / jQuery / D3 v3）。

原始碼遺失，本 repo 是從線上部署版本還原：
<https://storage.googleapis.com/aaixd/storybook/index/index.html>

## 研究背景

| | |
|---|---|
| 論文 | 兒童數位圖書館資訊視覺化網站設計─以圓夢繪本資料庫為例 |
| 英文題名 | Children Digital Library Information Visualization Website Design - A Case Study of Picture Book Database |
| 學校系所 | 國立臺北科技大學 互動設計系碩士班（職） |
| 學年度 / 口試日期 | 104 學年度 / 2016-06-17 |
| 關鍵詞 | 兒童資訊尋求、使用者介面設計、資訊視覺化 |
| 永久網址 | <https://hdl.handle.net/11296/n695tk>（臺灣博碩士論文知識加值系統） |

兒童因為識字量和詞彙認知有限，在文字式的圖書目錄裡找書常常卡關。本研究以國立公共資訊圖書館的「圓夢繪本資料庫」為藍本，改用圖示分類取代文字，設計出三種視覺化找書模式：**主題地圖**、**色塊**、**節點**。研究透過國小老師與圖書館員共 82 份有效專家問卷進行驗證。結果顯示：

- 多數專家認同用圖示重新分類，對兒童找書有幫助。
- 主題地圖模式的再訪意願和趣味性最高。
- 色塊模式色彩豐富、吸引兒童，但對找書的幫助不明顯。
- 節點模式能一覽完整的資訊架構，熟悉操作之後搜尋效率最好。

## 結構

| 路徑 | 說明 |
|---|---|
| `index/` | 首頁（CSS3 星空、行星動畫），三個入口分別進入三種搜尋模式 |
| `map/` | **主題地圖模式**：食物、動物園、交通、太空等主題場景，SVG 平移縮放 |
| `d3/tree/` | **節點模式**（檔案已遺失，見下方說明） |
| `d3/coffeewheel/` | **色塊模式**：分類輪盤 |
| `d3/books/` | 各分類的繪本清單（D3 v3），資料在 `js/data_*.js` |
| `img/books/ss/` | 繪本封面縮圖 |
| `map/demo_book.php` | 舊版 PHP + MySQL 查詢頁（已停用） |

## 本機執行

```bash
python3 -m http.server 8123
```

開啟 <http://localhost:8123/index/index.html>

## 還原狀況

伺服器上已不存在、無法取回的檔案：

- `d3/tree/index.html`：首頁第二個入口（節點模式）
- `d3/coffeewheel/js/index6.js`：色塊模式的主程式，所以這一頁目前不會動
- `img/books/183/183_P01.jpg`
- `map/db.inc.php`

從站內其他位置或 CDN 補回的第三方檔案：

- Font Awesome 4.2.0 字型（`fonts/`）
- `d3/coffeewheel/` 的 `css/`、`js/d3.min.js`、`js/jquery.min.js`、`js/jquery.svg.pan.zoom.js`、`js/mapbtn.js`（複製自 `d3/books/` 與 `map/`）
- `d3/books/js/jquery.svg.pan.zoom.js`（複製自 `map/js/`）

`map/demo_book.php` 原本寫死了資料庫帳密，現在改成讀 `DB_USER` / `DB_PASS` 環境變數。
