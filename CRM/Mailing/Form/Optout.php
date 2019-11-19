<?php
/*
 * Override default behaviour. You will now be opted out after loading the form
 * -> single-click opt-out
 */

/**
 *
 * @package CRM
 * @copyright CiviCRM LLC https://civicrm.org/licensing
 */
class CRM_Mailing_Form_Optout extends CRM_Core_Form
{

  public function preProcess()
  {

    $this->_type = 'optout';

    $this->_job_id = $job_id = CRM_Utils_Request::retrieve( 'jid', 'Integer', $this );
    $this->_queue_id = $queue_id = CRM_Utils_Request::retrieve( 'qid', 'Integer', $this );
    $this->_hash = $hash = CRM_Utils_Request::retrieve( 'h', 'String', $this );

    if (!$job_id || !$queue_id || !$hash )
    {
      throw new CRM_Core_Exception( ts( "Missing input parameters" ) );
    }

    // verify that the three numbers above match
    $q = CRM_Mailing_Event_BAO_Queue::verify( $job_id, $queue_id, $hash );
    if ( !$q )
    {
      throw new CRM_Core_Exception( ts( "There was an error in your request") );
    }

    list( $displayName, $email ) = CRM_Mailing_Event_BAO_Queue::getContactInfo( $queue_id );
    $this->assign( 'info_text', 'Your email adress <strong>' . $email . '</strong> was deleted from our mailinglist.' );
    $this->_email = $email;

    // start mod
    if ( CRM_Mailing_Event_BAO_Unsubscribe::unsub_from_domain( $job_id, $queue_id, $hash ) )
    {
      CRM_Mailing_Event_BAO_Unsubscribe::send_unsub_response( $queue_id, NULL, true, $job_id );
    }

    $statusMsg = ts('Email: %1 has been successfully opted out',
      [1 => $values['email_confirm']]
    );

    // end mod
  }

  public function buildQuickForm()
  {
    CRM_Utils_System::addHTMLHead( '<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">' );
    CRM_Utils_System::setTitle(ts( 'Your have been opted out successfully') );
  }

  public function postProcess()
  {
  }

}
