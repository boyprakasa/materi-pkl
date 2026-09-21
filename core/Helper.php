<?php

/**
 * core/helpers.php
 * Kumpulan fungsi bantuan (helper) yang bisa dipanggil di mana saja —
 * baik dari Controller maupun View — tanpa perlu bikin class dulu.
 */

/**
 * Menampilkan isi array/data (biasanya hasil query database) dalam
 * bentuk card Bootstrap yang rapi. Cocok dipakai di halaman index
 * saat masih development, untuk cek data mentahnya seperti apa.
 *
 * Contoh pemakaian di view:
 *   <?= debug_card($data['absensi']) ?>
 *   <?= debug_card($data['siswa'], 'Data Siswa') ?>
 *
 * @param array  $items  Data yang mau ditampilkan (array asosiatif/numerik)
 * @param string $label  Judul yang tampil di header card
 */
function debug_card(array $items, string $label = 'Data'): string
{
    $jumlah = count($items);

    // Buang label index numerik "[0] =>", "[1] =>", dst supaya lebih ringkas dibaca
    $isi = preg_replace('/\[\d+\]\s*=>\s*/', '', print_r($items, true));

    ob_start(); ?>
    <div class="card mb-4">
        <div class="card-header">
            <?= htmlspecialchars($label) ?> — Jumlah Data: <?= $jumlah ?>
        </div>
        <div class="card-body">
            <pre class="bg-dark text-light p-3 rounded mb-0"><code><?= htmlspecialchars($isi) ?></code></pre>
        </div>
    </div>
<?php
    return ob_get_clean();
}
