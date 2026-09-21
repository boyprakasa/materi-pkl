<?php

/**
 * models/Nilai.php
 * Semua query database untuk tabel "nilai" ada di sini.
 * Controller TIDAK boleh menulis query SQL langsung — selalu lewat Model.
 */

class Nilai
{
    private PDO $db;

    public function __construct()
    {
        global $pdo; // koneksi PDO dari config/database.php
        $this->db = $pdo;
    }

    /** Ambil semua data nilai */
    public function getAll(): array
    {
        $stmt = $this->db->query("
           SELECT
                a.*,
                b.nama_siswa,
                c.kode_mapel,
                c.nama_mapel,
                d.kelas,
                d.nama_jurusan
            FROM
                nilai AS a
                LEFT JOIN siswa AS b ON a.siswa_id = b.id
                LEFT JOIN mapel AS c ON a.mapel_id = c.id
                LEFT JOIN kelas AS d ON b.kelas_id = d.id
            ORDER BY
                mapel_id ASC
        ");
        return $stmt->fetchAll();
    }

    /** Ambil satu data nilai berdasarkan id */
    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM nilai WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    /** Tambah data nilai baru */
    public function create(array $data): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO nilai (siswa_id, mapel_id, jenis_nilai, nilai, keterangan)
             VALUES (?, ?, ?, ?, ?)"
        );
        return $stmt->execute([
            $data['siswa_id'],
            $data['mapel_id'],
            $data['jenis_nilai'],
            $data['nilai'],
            $data['keterangan'],
        ]);
    }

    /** Update data nilai */
    public function update($id, array $data): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE nilai SET siswa_id = ?, mapel_id = ?, jenis_nilai = ?, nilai = ?, keterangan = ?
             WHERE id = ?"
        );
        return $stmt->execute([
            $data['siswa_id'],
            $data['mapel_id'],
            $data['jenis_nilai'],
            $data['nilai'],
            $data['keterangan'],
            $id,
        ]);
    }

    /** Hapus data nilai */
    public function delete($id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM nilai WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
