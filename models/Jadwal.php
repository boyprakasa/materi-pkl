<?php

/**
 * models/Jadwal.php
 * Semua query database untuk tabel "jadwal" ada di sini.
 * Controller TIDAK boleh menulis query SQL langsung — selalu lewat Model.
 */

class Jadwal
{
    private PDO $db;

    public function __construct()
    {
        global $pdo; // koneksi PDO dari config/database.php
        $this->db = $pdo;
    }

    /** Ambil semua data jadwal */
    public function getAll(): array
    {
        $stmt = $this->db->query("
                SELECT
                    a.*,
                    b.kelas,
                    b.nama_jurusan,
                    c.kode_mapel,
                    c.nama_mapel,
                    d.nama_guru
                FROM
                    jadwal AS a
                    LEFT JOIN kelas AS b ON a.kelas_id = b.id
                    LEFT JOIN mapel AS c ON a.mapel_id = c.id
                    LEFT JOIN guru AS d ON a.guru_id = d.id
                ORDER BY
                    a.kelas_id ASC
                ");
        return $stmt->fetchAll();
    }

    /** Ambil satu data jadwal berdasarkan id */
    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM jadwal WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    /** Tambah data jadwal baru */
    public function create(array $data): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO jadwal (kelas_id, mapel_id, guru_id, hari, jam_mulai, jam_selesai)
             VALUES (?, ?, ?, ?, ?, ?)"
        );
        return $stmt->execute([
            $data['kelas_id'],
            $data['mapel_id'],
            $data['guru_id'],
            $data['hari'],
            $data['jam_mulai'],
            $data['jam_selesai'],
        ]);
    }

    /** Update data jadwal */
    public function update($id, array $data): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE jadwal SET kelas_id = ?, mapel_id = ?, guru_id = ?, hari = ?, jam_mulai = ?, jam_selesai = ?
             WHERE id = ?"
        );
        return $stmt->execute([
            $data['kelas_id'],
            $data['mapel_id'],
            $data['guru_id'],
            $data['hari'],
            $data['jam_mulai'],
            $data['jam_selesai'],
            $id,
        ]);
    }

    /** Hapus data jadwal */
    public function delete($id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM jadwal WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
