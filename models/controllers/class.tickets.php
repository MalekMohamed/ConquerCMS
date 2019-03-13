<?php

/**
 * Created by PhpStorm.
 * User: Veigar
 * Date: 1/31/2017
 * Time: 3:42 PM
 */
class tickets extends ranks
{
    public function status($state)
    {
        if ($state == 0) return 'Appending For Reply';
        if ($state == 1) return 'Pending';
        if ($state == 2) return 'Answered';
        if ($state == 3) return 'Closed';
        return (Empty($state) ? '' : 'None');
    }

    public function view_all()
    {
        $query = $this->select($this->account,'tickets', '*', array('id != ?'), '0');
        return array($query->rowCount(), $query->fetchAll());
    }

    public function add_ticket($user, $title, $problem, $cate)
    {
        $time = date("d-M-Y h:i a");
        $query = $this->account->prepare("INSERT INTO tickets (title,category,problem,User,time,Status) VALUES (:title,:cate,:problem,:user,:time,:status)");
        $query->execute(array(
            'title' => $title,
            'cate' => $cate,
            'problem' => $problem,
            'user' => $user,
            'time' => $time,
            'status' => 0
        ));
    }

    public function get_tickets_by_user($user)
    {
        $query = $this->select($this->account,'tickets', '*', array('User = ?'), $user);
        return array($query->rowCount(), $query->fetchAll());
    }

    public function update_status($ticketid, $status)
    {
        $time = date("d-M-Y h:i a");
        $query = $this->account->prepare("UPDATE tickets SET Status = ?,time = ? WHERE id = ?");
        $query->execute(array($status, $time, $ticketid));
        return '1';
    }

    public function view_ticket($id)
    {
        $query = $this->select($this->account,'tickets', '*', array('id = ?'), $id);
        return array($query->rowCount(), $query->fetch());
    }

    public function get_replys($id)
    {
        $query = $this->select($this->account,'tickets_replys', '*', array('ticketid = ?'), $id);
        return array($query->rowCount(), $query->fetchAll());
    }

    public function reply($ticketid, $user, $reply)
    {
        $time = date("d-M-Y h:i a");
        $query = $this->account->prepare("INSERT INTO tickets_replys Values (
                       :ticket_id,
                        :reply,
                       :user,
                       :time
                       )
                       ");

        $query->execute(array('ticket_id' => $ticketid,  'reply' => $reply, 'user' => $user,'time' => $time));
        return '1';

    }

}
