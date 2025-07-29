// server.js — Node.js backend for LH Jewellers

const express = require('express');
const fs = require('fs');
const cors = require('cors');

const app = express();
const PORT = 3000;

app.use(cors());
app.use(express.json());

// ✅ Serve your HTML files (dashboard.html, rate-update.html, etc.)
app.use(express.static('public'));

// ✅ Read current rates from JSON file
app.get('/api/rates', (req, res) => {
  fs.readFile('rates.json', 'utf8', (err, data) => {
    if (err) return res.status(500).json({ error: 'Failed to read rates' });
    res.json(JSON.parse(data));
  });
});

// ✅ Save updated rates
app.post('/api/rates', (req, res) => {
  const rates = req.body;
  fs.writeFile('rates.json', JSON.stringify(rates, null, 2), (err) => {
    if (err) return res.status(500).json({ error: 'Failed to save rates' });
    res.json({ message: 'Rates updated successfully' });
  });
});

app.listen(PORT, () => {
  console.log(`✅ Server running at: http://localhost:${PORT}`);
});
