<?php

class TalkClaimMapper extends ApiMapper
{
    /**
     * Add a pending talk claim submitted by a speaker
     *
     * @param $talk_id
     * @param $claim_id
     * @param $speaker_id
     * @param $submitted_by_id
     * @return int The new pending claim ID
     */
    public function addPendingClaimFromSpeaker($talk_id, $claim_id, $speaker_id, $submitted_by_id)
    {
        $sql = 'insert into pending_talk_claims (talk_id, submitted_by, speaker_id, date_added, claim_id, '
                . 'user_approved_at) '
                . 'VALUES(:talk_id, :speaker_id, UNIX_TIMESTAMP(), :claim_id, UNIX_TIMESTAMP())';

        $stmt = $this->_db->prepare($sql);
        $stmt->execute(array(
            'talk_id' => $talk_id,
            'submitted_by' => $submitted_by_id,
            'claim_id' => $claim_id,
            'speaker_id' => $speaker_id,
        ));

        return $this->_db->lastInsertId();
    }

    /**
     * Add a pending talk claim submitted by an event host/admin
     *
     * @param $talk_id
     * @param $claim_id
     * @param $speaker_id
     * @param $submitted_by_id
     * @return integer The new pending claim ID
     */
    public function addPendingClaimForSpeaker($talk_id, $claim_id, $speaker_id, $submitted_by_id)
    {
        $sql = 'insert into pending_talk_claims (talk_id, submitted_by, speaker_id, date_added, claim_id, '
            . 'host_approved_at) '
            . 'VALUES(:talk_id, :speaker_id, UNIX_TIMESTAMP(), :claim_id, UNIX_TIMESTAMP())';

        $stmt = $this->_db->prepare($sql);
        $stmt->execute(array(
            'talk_id' => $talk_id,
            'submitted_by' => $submitted_by_id,
            'claim_id' => $claim_id,
            'speaker_id' => $speaker_id,
        ));

        return $this->_db->lastInsertId();
    }
}
