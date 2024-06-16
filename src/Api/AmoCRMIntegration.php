<?php
namespace Fanil\Amocrm\Api;

use AmoCRM\Client\AmoCRMApiClient;
use AmoCRM\Client\LongLivedAccessToken;
use AmoCRM\Collections\ContactsCollection;
use AmoCRM\Collections\CustomFieldsValuesCollection;
use AmoCRM\Collections\Leads\LeadsCollection;
use AmoCRM\Exceptions\AmoCRMApiException;
use AmoCRM\Models\ContactModel;
use AmoCRM\Models\CustomFieldsValues\MultitextCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\MultitextCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueModels\MultitextCustomFieldValueModel;
use AmoCRM\Models\LeadModel;
use Dotenv;

class AmoCRMIntegration
{
    private string $amocrmToken;
    private string $amocrmDomain;
    private string $pipelineId;
    private AmoCRMApiClient $apiClient;

    public function __construct()
    {
        $this->initENV();
        $this->setAccess();
    }

    private function initENV(): void
    {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        $this->amocrmToken = $_ENV['AMOCRM_TOKEN'];
        $this->amocrmDomain = $_ENV['AMOCRM_DOMAIN'];
        $this->pipelineId = $_ENV['PIPELINE_ID'];
    }

    public function setAccess(): void
    {
        $this->apiClient = new AmoCRMApiClient();

        $longLivedAccessToken = new LongLivedAccessToken($this->amocrmToken);
        $this->apiClient->setAccessToken($longLivedAccessToken)
            ->setAccountBaseDomain($this->amocrmDomain);
    }

    public function sendLead(string $title, string $firstName, string $lastName, string $phone): array
    {
        $leadsCollection = new LeadsCollection();

        $lead = (new LeadModel())
            ->setName($title)
            ->setPipelineId($this->pipelineId)
            ->setContacts(
                (new ContactsCollection())
                    ->add(
                        (new ContactModel())
                            ->setFirstName($firstName)
                            ->setLastName($lastName)
                            ->setCustomFieldsValues(
                                (new CustomFieldsValuesCollection())
                                    ->add(
                                        (new MultitextCustomFieldValuesModel())
                                            ->setFieldCode('PHONE')
                                            ->setValues(
                                                (new MultitextCustomFieldValueCollection())
                                                    ->add(
                                                        (new MultitextCustomFieldValueModel())
                                                            ->setValue($phone)
                                                    )
                                            )
                                    )
                            )
                    )
            );
        $leadsCollection->add($lead);

        // Создадим сделки
        try {
            $this->apiClient->leads()->addComplex($leadsCollection);
            return [
                'error' => false
            ];
        } catch (AmoCRMApiException $e) {
            return [
                'error' => true,
                'errorCode' => $e->getCode(),
                'errorMessage' => $e->getMessage(),
            ];
        }
    }
}
