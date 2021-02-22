<?php

class Comic_model extends CI_Model
{
    // Genre
    public function addGenre()
    {
        $data = [
            'nama_genre' => $this->input->post('nama_genre', true)
        ];
        $this->db->insert('genre', $data);
    }

    public function getAllGenre()
    {
        return $this->db->select('id_genre,nama_genre')
            ->order_by('id_genre', 'asc')
            ->get('genre')
            ->result_array();
    }

    public function countAllGenre()
    {
        return $this->db
            ->from('genre')
            ->count_all_results();
    }

    public function editGenre($id)
    {
        $data = [
            'nama_genre' => $this->input->post('nama_genre', true)
        ];
        $this->db->where('id_genre', $id)
            ->update('genre', $data);
    }

    public function getGenre($id)
    {
        return $this->db->get_where('genre', ['id_genre' => $id])->row_array();
    }

    public function delGenre($id)
    {
        return $this->db->delete('genre', ['id_genre' => $id]);
    }

    // Comic
    public function getAllComic()
    {
        return $this->db->select('id_komik,judul,jenis,penulis,SUBSTRING(deskripsi,1,60) as deskripsi,status,rilis,usia_pembaca,rating,imageUrl,is_active')
            ->order_by('id_komik', 'asc')
            ->get('comics')
            ->result_array();
    }

    public function getHotComics($limit = null, $start = null, $keyword = null)
    {
        return $this->db->select('id_komik,judul,rating,imageUrl,SUBSTRING(deskripsi,1,60) as deskripsi')
            ->like('judul', $keyword)
            ->order_by('rating', 'desc')
            ->get('comics', $limit, $start)
            ->result_array();
    }

    public function getRelatedComic($keyword)
    {
        return $this->db->select('id_komik,judul,rating,imageUrl,SUBSTRING(deskripsi,1,60) as deskripsi')
            ->like('jenis', $keyword)
            ->order_by('rating', 'desc')
            ->get('comics')
            ->result_array();
    }

    public function getLastComic()
    {
        return $this->db->select('id_komik')
            ->order_by('id_komik', 'desc')
            ->limit(1)
            ->get('comics')->row_array();
    }

    public function getComic($id)
    {
        return $this->db->get_where('comics', ['id_komik' => $id])->row_array();
    }

    public function countAllComics($keyword = null)
    {
        return $this->db->like('judul', $keyword)
            ->from('comics')
            ->count_all_results();
    }

    public function addComic($data)
    {
        $this->db->insert('comics', $data);
    }

    public function editComic($data, $id)
    {
        $this->db->where('id_komik', $id)->update('comics', $data);
    }

    public function delComic($id)
    {
        return $this->db->delete('comics', ['id_komik' => $id]);
    }

    // detail komik
    public function addDetailComic($data)
    {
        $this->db->insert('detail_comic', $data);
    }

    public function getDetailComic($id)
    {
        return  $this->db->select('id_genre')
            ->get_where('detail_comic', ['id_comic' => $id])->result_array();
    }

    public function delDetailComic($id)
    {
        return $this->db
            ->delete('detail_comic', ['id_comic' => $id]);
    }

    // status_comic
    public function getAllStatus()
    {
        return $this->db->get('status_comic')->result_array();
    }
}
