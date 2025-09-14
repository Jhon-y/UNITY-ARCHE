using UnityEngine;
using UnityEngine.SceneManagement;

public class SceneTeleporter : MonoBehaviour
{
    [Tooltip("Cena para onde o jogador vai")]
    public string targetScene;

    [Tooltip("ID do spawn na cena de destino")]
    public string targetSpawnID;

    private void OnTriggerEnter2D(Collider2D other) // use OnTriggerEnter se for 3D
    {
        if (other.CompareTag("Player"))
        {
            // Salva onde o player deve aparecer na próxima cena
            PlayerPrefs.SetString("NextSpawn", targetSpawnID);

            // Carrega a cena
            SceneManager.LoadScene(targetScene);
        }
    }
}
